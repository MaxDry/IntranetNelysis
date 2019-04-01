<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NelysisController extends AbstractController
{
    /**
     * @Route("/", name="nelysis")
     */
    public function index()
    {
        return $this->render('nelysis/index.html.twig', [
            'controller_name' => 'NelysisController',
        ]);
    }

    /**
     * @Route("/home", name="home")
     */
    public function home(){
        return $this->render('nelysis/home.html.twig', [
            'title' => "Bienvenue ici chez Nelysis",
            'age' => 31
        ]);
    }
}
