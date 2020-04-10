<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController
{
    /**
     * @Route("/", name="landing-page")
     */
    public function index() {
        return $this->render('landing-page.html.twig');
    }
    /**
     * @Route("/canal/{channel}", name="canals-page")
     */
    public function prova($channel) {
        return $this->render('canal-detall.html.twig', [
            'canals' => [
                [
                    'id' => 1,
                    'name' => "canal 1"
                ],
                [
                    'id' => 2,
                    'name' => "canal 2"
                ],
                [
                    'id' => 3,
                    'name' => "canal 3"
                ],
                [
                    'id' => 4,
                    'name' => "canal 4"
                ]
            ]
        ]);
    }
}