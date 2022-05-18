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
        $productCount = 222;
        $username = "Denis";
        $controller_name="MainController";


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'productCount' =>$productCount,
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

    public function aboutUs(): Response
    {
        return "à propos de nous";
    }
}
