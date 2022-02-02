<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'mail')]
    public function index(): Response
    {
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);
    }

    #[Route('/mail/{username}', name: 'mail')]
    public function envoyerUnMail($username, MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('admin@eni.fr')
            ->to($username . '@eni.fr')
            ->subject('convocation Bilan de formation')
            ->text('Nul mais constant.')
        ;
        $mailer->send($email);
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);
    }
}
