<?php


namespace App\Controller;


use App\Entity\Habitat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class HabitatsPageController extends AbstractController
{
    /**
     * @Route("/habitats", name="habitats-page")
     */
    public function index() {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $habitats = $this->getDoctrine()->getManager()->getRepository(Habitat::class)->findAll();

        $state = [
            'module' => 'habitats',
            'state' => [
                'list' => $habitats
            ]
        ];
        return $this->render('habitats-page.html.twig', [
            'state' => $serializer->serialize($state, 'json')
        ]);
    }
}