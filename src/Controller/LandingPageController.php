<?php


namespace App;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController
{
    /**
     * @Route("/")
     */
    public function index() {
        return new Response('hola amiguis');
    }
}