<?php

namespace App\Controller;

use App\Entity\Animal;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AnimalController extends AbstractController
{
    /**
     * @Route("/api/animals", methods={"GET"})
     */
    public function index(): JsonResponse
    {

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $repository  = $this->getDoctrine()->getManager()->getRepository(Animal::class);
        return new JsonResponse(json_decode($serializer->serialize($repository->findAll(), 'json')));
    }

    /**
     * @Route("/api/animals/{animal}", methods={"GET"})
     * @param Animal $animal
     * @return JsonResponse
     */
    public function show(Animal $animal)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        return new JsonResponse(json_decode($serializer->serialize($animal, 'json')));
    }

    /**
     * @Route("/api/animals", methods={"POST"})
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return JsonResponse
     */
    public function push(Request $request, ValidatorInterface $validator): JsonResponse
    {

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $entityManager = $this->getDoctrine()->getManager();
        $animalRequest = json_decode($request->getContent());

        $nouAnimal = new Animal();
        $nouAnimal->setName($animalRequest->name);
        $nouAnimal->setEspecie($animalRequest->especie);
        $nouAnimal->setAltura($animalRequest->altura);
        $nouAnimal->setPes($animalRequest->pes);

        $errors = $validator->validate($nouAnimal);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, 400);
        }

        $entityManager->persist($nouAnimal);

        $entityManager->flush();

        return new JsonResponse(json_decode($serializer->serialize($nouAnimal, 'json')));
    }

    /**
     * @Route("/api/animals/{animal}", methods={"PUT"})
     * @param Animal $animal
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function update(Animal $animal, Request $request, ValidatorInterface $validator)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $entityManager = $this->getDoctrine()->getManager();
        $animalRequest = json_decode($request->getContent());

        $animal->setName($animalRequest->name);
        $animal->setEspecie($animalRequest->especie);
        $animal->setAltura($animalRequest->altura);
        $animal->setPes($animalRequest->pes);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($animal);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new JsonResponse(json_decode($serializer->serialize($animal, 'json')));
    }

    /**
     * @Route("/api/animals/{animal}", methods={"DELETE"})
     * @param Animal $animal
     * @return JsonResponse
     */
    public function destroy(Animal $animal)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $entityManager = $this->getDoctrine()->getManager();

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->remove($animal);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new JsonResponse(json_decode($serializer->serialize($animal, 'json')));
    }
}
