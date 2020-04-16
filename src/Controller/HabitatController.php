<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Habitat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HabitatController extends AbstractController
{
    /**
     * @Route("/api/habitats", methods={"GET"})
     */
    public function index(): JsonResponse
    {

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $repository  = $this->getDoctrine()->getManager()->getRepository(Habitat::class);
        return new JsonResponse(json_decode($serializer->serialize($repository->findAll(), 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ])));
    }

    /**
     * @Route("/api/habitats/{habitat}", methods={"GET"})
     * @param Habitat $habitat
     * @return JsonResponse
     */
    public function show(Habitat $habitat)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        return new JsonResponse(json_decode($serializer->serialize($habitat, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ])));
    }

    /**
     * @Route("/api/habitats", methods={"POST"})
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
        $habitatRequest = json_decode($request->getContent());

        $nouHabitat = new Habitat();
        $nouHabitat->setNom($habitatRequest->nom);
        $nouHabitat->setDescripcio($habitatRequest->descripcio);
        foreach  ($habitatRequest->animals as $animal){
            $animalRepo = $this->getDoctrine()->getManager()->getRepository(Animal::class)->find($animal->id);
            $nouHabitat->addAnimal($animalRepo);
        }

        $errors = $validator->validate($nouHabitat);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, 400);
        }

        $entityManager->persist($nouHabitat);

        $entityManager->flush();

        return new JsonResponse(json_decode($serializer->serialize($nouHabitat, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ])));
    }

    /**
     * @Route("/api/habitats/{habitat}", methods={"PUT"})
     * @param Habitat $habitat
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function update(Habitat $habitat, Request $request, ValidatorInterface $validator)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $entityManager = $this->getDoctrine()->getManager();
        $habitatRequest = json_decode($request->getContent());

        $habitat->setNom($habitatRequest->nom);
        $habitat->setDescripcio($habitatRequest->descripcio);

        $habitat->removeAllAnimals();

        foreach  ($habitatRequest->animals as $animal){
            $animalRepo = $this->getDoctrine()->getManager()->getRepository(Animal::class)->find($animal->id);
            $habitat->addAnimal($animalRepo);
        }

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($habitat);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new JsonResponse(json_decode($serializer->serialize($habitat, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ])));
    }

    /**
     * @Route("/api/habitats/{habitat}", methods={"DELETE"})
     * @param Habitat $habitat
     * @return JsonResponse
     */
    public function destroy(Habitat $habitat)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $entityManager = $this->getDoctrine()->getManager();

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->remove($habitat);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new JsonResponse(json_decode($serializer->serialize($habitat, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ])));
    }
}
