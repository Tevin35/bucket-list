<?php

namespace App\Controller;
use App\Repository\WishRepository;
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

    #[Route('/wishIndex', name: 'wish_index')]
    public function wishIndex(): Response
    {
        return $this->render('wish/index.html.twig');
    }

    #[Route('/wish/list', name: 'list')]
    public function list(WishRepository $wishRepository): Response
    {
        $listWishs = $wishRepository ->findAll();
        return $this->render('wish/list.html.twig', [
            'listWishs' => $listWishs,
        ]);
    }

    #[Route('/wish/detail', name: 'wishdetail')]
    public function detail(): Response
    {
        return $this->render('wish/detail.html.twig');
    }

    #[Route('/wish/delete/{id}', name: 'delete')]
    public function delete($id,WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);
        $wishRepository->remove($wish,true);
        echo "suppression du souhait effectuée";
        die();
        /*return $this->render('book/add.html.twig', [
            'controller_name' => 'BookController',
        ]);*/
    }
}
