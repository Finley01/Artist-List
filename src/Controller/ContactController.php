<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $message = (new \Swift_Message($contactFormData['subject']))
                ->setFrom($contactFormData['email'])
                ->setTo('ixamxr34per@gmail.com')
                ->setBody(
                    $contactFormData['message'],
                    'text/plain'
                );
            $mailer->send($message);

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
    ]);
    }
}
