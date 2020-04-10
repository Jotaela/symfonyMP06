<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HabitatController extends AbstractController
{
    /**
     * @Route("/habitat", name="habitat")
     */
    public function index()
    {
        return $this->render('habitat/index.html.twig', [
            'controller_name' => 'HabitatController',
        ]);
    }
}
