<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use App\Services\Censurator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class WishController extends AbstractController
{
    #[IsGranted("ROLE_USER")]
    #[Route('/list', name: 'wish_list')]
    public function list(WishRepository $wishRepository): Response
    {
    $wishes = $wishRepository->findBy(['isPublished'=> true],['dateCreated' => 'DESC']);

        return $this->render('wish/list.html.twig', compact("wishes"));

    }
    #[IsGranted("ROLE_USER")]
    #[Route('/detail/{id}', name: 'wish_detail')]
    public  function  detail(Wish $wish): Response //$id, WishRepository $wishRepository
    {

        //$wish = $wishRepository->find($id);
        return $this->render('wish/detail.html.twig',
        compact("wish")
        );

    }
    #[IsGranted("ROLE_USER")]
    #[Route('/formu', name: 'wish_formu')]
    public function formu(Request $request,
                          EntityManagerInterface $entityManager,
                          WishRepository $wishRepository,
                            Censurator $censurator
    ):Response{

        $wish = new Wish();
        $wish->setAuthor($this->getUser()->getUserIdentifier());
        $monFormulaire1 = $this-> createForm(WishType::class,$wish);
        $monFormulaire1->handleRequest($request);

        $descriptionPurifier = $censurator->purify($wish->getDescription());
        $titrePurifier = $censurator->purify($wish->getTitle());

        $wish->setTitle($titrePurifier);
        $wish->setDescription($descriptionPurifier);


        if ($monFormulaire1->isSubmitted() && $monFormulaire1->isValid()
        ){
            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('bravo','le formulaire a bien été soumis');
            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        return $this->renderForm('wish/formu.html.twig', compact('monFormulaire1'));
    }
}

