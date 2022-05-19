<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    #[Route('/wish', name: 'app_wish')]
    public function index(): Response
    {
        //Déclaration de mes variables que je vais passer à ma vue.
        $controller_name="WishController";

        return $this->render('main/index.html.twig', [
            'controller_name' => 'WishController',
        ]);

    }

    #[Route('/wish', name: 'wish_index')]
    public function wishIndex(): Response
    {
        return $this->render('wish/index.html.twig');
    }

    #[Route('/wish', name: 'wishlist')]
    public function list(): Response
    {
        return $this->render('wish/list.html.twig');
    }

    #[Route('/wish', name: 'wishdetail')]
    public function detail(): Response
    {
        return $this->render('wish/detail.html.twig');
    }
}
