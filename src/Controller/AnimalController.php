<?php

namespace App\Controller;

use App\Entity\Animal;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AnimalController extends AbstractController
{
    /**
     * @Route("/api/animal", methods={"GET"})
     */
    public function index(): JsonResponse
    {
        $repository  = $this->getDoctrine()->getManager()->getRepository(Animal::class);
        return new JsonResponse($repository->findAll());
    }

    /**
     * @Route("/api/animal/{id}", methods={"GET"})
     */
    public function show($id)
    {
        $animal = $this->getDoctrine()
            ->getRepository(Animal::class)
            ->find($id);

        if (!$animal) {
            return new JsonResponse([404]);
        }

        return new JsonResponse($animal);
    }

    /**
     * @Route("/api/animal", methods={"POST"})
     */
    public function push(ValidatorInterface $validator, Animal $animal): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        $errors = $validator->validate($animal);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $entityManager->persist($animal);

        $entityManager->flush();


        return new Response($animal);
    }

    /**
     * @Route("/api/animal/{id}", methods={"PUT"})
     */
    public function update(ValidatorInterface $validator, $id)
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $animal = new Animal();
        $animal->setName('Keyboard');


        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }
}
