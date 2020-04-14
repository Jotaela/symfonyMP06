<?php


namespace App\Controller;


use App\Entity\Animal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AnimalsPageController extends AbstractController
{

    /**
     * @Route("/", name="landing-page")
     */
    public function index() {
        return $this->render('landing-page.html.twig');
    }
    /**
     * @Route("/animals", name="aniamls-page")
     */
    public function prova() {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $animals = $this->getDoctrine()->getManager()->getRepository(Animal::class)->findAll();
        $state = [
            'module' => 'animals',
            'state' => [
                'list' => $animals
            ]
        ];
        return $this->render('animals-page.html.twig', [
            'state' => $serializer->serialize($state, 'json')
        ]);
    }
}