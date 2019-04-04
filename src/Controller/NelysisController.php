<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NelysisController extends AbstractController
{
    /**
     * @Route("/", name="nelysis")
     */
    public function home()
    {
        return $this->render('nelysis/home.html.twig', [
            'controller_name' => 'NelysisController',
        ]);
    }
}
