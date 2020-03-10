<?php

namespace App\Controller;

use App\Entity\Performance;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $thisWeek = $this->getDoctrine()->getRepository(Performance::class)->getByPeriodPerformances(new DateTime("sunday this week"), new DateTime());
        $history = $this->getDoctrine()->getRepository(Performance::class)->getByPeriodPerformances(new DateTime(), new DateTime("-1000 year"));
        $all = $this->getDoctrine()->getRepository(Performance::class)->findAll();
        return $this->render('index/index.html.twig', [
            'thisWeek' => $thisWeek,
            'history' => $history,
            'all' => $all,
        ]);
    }
}
