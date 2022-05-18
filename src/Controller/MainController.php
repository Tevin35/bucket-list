<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        //Déclaration de mes variables que je vais passer à ma vue.
        $username = "Tevin";
        $controller_name="MainController";


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'username' =>$username,
        ]);



    }

    /**
     * Affiche la page d'accueil.
     * @return Response
     */
    #[Route('/', name: 'home')]
    //Route en version avant PHP 8.
    //@Route("/",name="home")
    public function home(): Response
    {
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * Affiche une page de test.
     * @return Response
     */
    #[Route('/test', name: 'test')]
    public function test(): Response
    {
        return $this->render('main/test.html.twig');
    }

    /**
     * Affiche une page à propos
     * @return Response
     */
    #[Route('/about_us', name: 'about_us')]
    public function aboutUs(): Response
    {
        return $this->render('main/about-us.html.twig');
    }

/*
     * Affiche la page wishlist
     * @return Response

    #[Route('/wishlist', name: 'wishlist')]
    public function wishlist(): Response
    {
        return $this->render('wish/index.html.twig');
    }
    */
}
