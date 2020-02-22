<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response("La page d'accueil");
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug = 'yeah')
    {
        return new Response(sprintf("Voici l'article : %s", $slug));
    }
}