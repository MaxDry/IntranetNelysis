<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\News;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;


use App\Repository\NewsRepository;
use App\Form\NewsType;

/**
* @Route("/news")
*/
class NewsController extends AbstractController
{
    /**
     * @Route("/", name="news")
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

    /**
     * @Route("/new", name="news_create")
     * @Route("{id}/edit", name="news_edit")
     */
    public function form(News $news = null, Request $request, ObjectManager $manager)
    {
        if(!$news){
            $news = new News();
        }

        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$news->getId()){
                $news->setCreatedAt(new \DateTime());
            }

            $manager->persist($news);
            $manager->flush();

            return $this->redirectToRoute('news');

        }

        return $this->render('news/create.html.twig', [
            'formNews' => $form->createView(),
            'editMode' => $news->getId() !== null
        ]);

    }
}
