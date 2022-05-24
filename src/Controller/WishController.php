<?php

namespace App\Controller;
use App\Entity\Wish;
use App\Form\CreateWishType;
use App\Repository\WishRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function list(WishRepository $repo): Response
    {
        //$wishes= $repo->findBy([],["dateCreated"=>"DESC"]);
        $wishes=$repo->sortedByDate();
        //$wishes = ["Manger des frites au canada", "aller à la fête de la bière","Aller au Wacken"];
        return $this->render('wish/list.html.twig',
            ['wishes'=>$wishes]);
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function detail($id,WishRepository $repo): Response
    {
        $wish=$repo->find($id);
        return $this->render('wish/detail.html.twig', [
            'id' => $id,
            'wish' => $wish
        ]);
    }


    #[Route('/edit/{id}', name: 'edit')]
    public function edit(int $id,WishRepository $repo, Request $request): Response
    {
        $wish = $repo->find($id);

        $wishForm = $this->createForm(CreateWishType::class, $wish);
        $wishForm->handleRequest($request);

        //traitement du formulaire
        if($wishForm->isSubmitted() && $wishForm->isValid()){

            $repo->add($wish, true);
            $this->addFlash("success", "Voeu ajouté avec succès !");
            return $this->redirectToRoute("wish_detail", ["id" => $wish->getId()]);
        }

        return $this->render('wish/add.html.twig', [
            'wishForm' => $wishForm->createView()
        ]);
    }

    #[Route('/add', name: 'add')]
    public function add(WishRepository $repo, Request $request): Response
    {
        //création d'un formulaire
        //création d'un nouveau voeu
        $wish = new Wish();
        $wish
            ->setDateCreated(new DateTime())
            ->setIsPublished(true)
            ->setAuthor("Michel");

        $wishForm = $this->createForm(CreateWishType::class, $wish);
        $wishForm->handleRequest($request);

        //traitement du formulaire
        if($wishForm->isSubmitted() && $wishForm->isValid()){

            $repo->add($wish, true);
            $this->addFlash("success", "Voeu ajouté avec succès !");
            return $this->redirectToRoute("wish_detail", ["id" => $wish->getId()]);
        }

        return $this->render('wish/add.html.twig', [
            'wishForm' => $wishForm->createView()
        ]);
    }
}


//    #[Route('/', name: 'app_wish')]
//    public function index(): Response
//    {
//        //Déclaration de mes variables que je vais passer à ma vue.
//        $controller_name="WishController";
//
//        return $this->render('main/index.html.twig', [
//            'controller_name' => 'WishController',
//        ]);
//
//    }
//
//    #[Route('/list', name: 'wish_list')]
//    public function list(WishRepository $wishRepository): Response
//    {
//        $listWishs = $wishRepository ->findAll();
//        return $this->render('wish/list.html.twig', [
//            'listWishs' => $wishRepository->findAll()
//        ]);
//    }
//
//    #[Route('/add', name: 'add')]
//    public function add(Request $request, WishRepository $wishRepository): Response
//    {
//        //Création d'un formulaire
//        //Création d'un nouveau voeu
//        $wish = new Wish();
//        $wish
//            ->setDateCreated(new \DateTime())
//            ->setIsPublished(true)
//            ->setAuthor("Michel");
//
//        $wishForm = $this->createForm(CreateWishType::class, $wish);
//
//
//        // associe les paramètres de la requête à l'instance de wish
//        $wishForm->handleRequest($request);
//
//        //récupération de champs non mappé
//        dump($wishForm->get("description")->getData());
//
//        //si le formulaire est soumis
//        if($wishForm->isSubmitted() && $wishForm->isValid()){
//            //je l'enregistre
//            $wishRepository->add($wish, true);
//
//            //récupération du champ
//            dump($wishForm->get("description"))->getData();
//
//            //j'ajoute du feedback utilisateur
//            $this->addFlash("success", "Le voeu a été enregistré !");
//
//            //je redirige vers la liste des produits
//            return $this->redirectToRoute("wish_detail", ["id" => $wish->getId()]);
//        }
//
//        dump($wish);
//
//        //traitement du formulaire
//
//        return $this->render('wish/add.html.twig', [
//            'wishForm' => $wishForm->createView(),
//        ]);
//    }
//
//    #[Route('/wish/detail', name: 'wish_detail')]
//    public function detail(): Response
//    {
//        return $this->render('wish/detail.html.twig');
//    }

/*
 #[Route('/wish/delete/{id}', name: 'delete')]
    public function delete($id,WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);
        $wishRepository->remove($wish,true);
        echo "suppression du souhait effectuée";
        die();
        /*return $this->render('book/add.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }
*/

