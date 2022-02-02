<?php

namespace App\Controller;

use App\Entity\Animaux;
use App\Form\AnimauxType;
use App\Repository\AnimauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main1', name: 'main_homeMain')]
    public function homeMain(){
        return $this->render('main_homeMain.html.twig');
    }

    #[Route('/main', name: 'main_home')]
    public function home(Request $request,
                         EntityManagerInterface $entityManager,
                         AnimauxRepository $animauxRepository

    ): Response

    {

    //  $chienVegetariens = $animauxRepository->findRaceVegetarien('chien');
     //   dump($chienVegetariens);

       // return $this->render('main/home.html.twig', compact("chienVegetariens"));


        $animaux = new Animaux();
        $monFormulaire = $this-> createForm( AnimauxType::class,$animaux);
        //return $this->render('main/home.html.twig', ["monFormulaire" => $monFormulaire->createView()]);
        $monFormulaire->handleRequest($request);
        if ($monFormulaire->isSubmitted() && $monFormulaire->isValid()
        ){
            $entityManager->persist($animaux);
            $entityManager->flush();

            $this->addFlash('bravo','le formulaire a bien été soumis');
           return $this->redirectToRoute('main_home');
        }






        return $this->renderForm('main/home.html.twig', compact("monFormulaire"));
    }


    #[Route('/About', name: 'main_Aboutus')]
    public function Aboutus(): Response
    {


        return $this->render('main/Aboutus.html.twig',

        );
    }
    




}
