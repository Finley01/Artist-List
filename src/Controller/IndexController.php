<?php

namespace App\Controller;

use App\Entity\Performance;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $performances = $this->getDoctrine()->getRepository(Performance::class)->findAll();

        return $this->render('index/index.html.twig', [
            'performances' => $performances,
        ]);
    }
}
