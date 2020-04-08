<?php


namespace App\Controller;


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
    /**
     * @Route("/canal/{channel}")
     */
    public function prova($channel) {
        return new Response(sprintf('queloque friendo %s', $channel));
    }
}