<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\News;

class NewsController extends AbstractController
{
    /**
     * @Route("/news", name="news")
     */
    public function index()
    {

        $repo = $this->getDoctrine()->getRepository(News::class);

        $news = $repo->findAll();

        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
            'news' => $news
        ]);
    }
}
