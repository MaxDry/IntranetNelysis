<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/news")
*/
class NewsController extends AbstractController
{
    /**
     * @Route("/", name="news", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request, NewsRepository $repo)
    {
       
        $queryNews = $repo->getNews();
        $paginationNews = $paginator->paginate(
            $queryNews, 
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        

        return $this->render('news/index.html.twig', [
            'news' => $queryNews,
            'paginationNews' => $paginationNews
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
