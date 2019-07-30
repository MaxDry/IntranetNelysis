<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use App\Repository\UserRepository;
use App\Repository\MemberRepository;


use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
       
        $queryNews = $repo->getNews('Soluta libero.');
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
     * @Route("/{id}/edit", name="news_edit")
     */
    public function edit(News $news = null, Request $request, ObjectManager $manager)
    {   
        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
                $news->setUpdatedAt(new \DateTime());

            $manager->persist($news);
            $manager->flush();

            return $this->redirectToRoute('news');

        }

        return $this->render('news/update.html.twig', [
            'formNews' => $form->createView(),
            'news' => $news,
        ]);

    }

    /**
     * @Route("/new", name="news_create")
     */
    public function create(News $news = null, Request $request, ObjectManager $manager)
    {   
        $news = new News();

        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $news->setCreatedAt(new \DateTime());

            $manager->persist($news);
            $manager->flush();

            return $this->redirectToRoute('news');

        }

        return $this->render('news/create.html.twig', [
            'formNews' => $form->createView(),
            'news' => $news,
            'editMode' => $news->getId() !== null
        ]);

    }

    /**
     * @Route("/delete", name="news_delete")
     */
    public function delete(Request $request, NewsRepository $repoNews)
    {   
        $id = $request->request->get("value");

        
        $entityManager = $this->getDoctrine()->getManager();
        $news = $repoNews->findOneById($id);
      
       
        $entityManager->remove($news);
        $entityManager->flush();

        $data = [
             'result' => true
        ];

        return new JsonResponse($data);
    }

    
}
