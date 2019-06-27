<?php

namespace App\Controller;

use App\Entity\LineUp;
use App\Form\LineUpType;
use App\Repository\LineUpRepository;
use Knp\Component\Pager\PaginatorInterface;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
* @Route("/lineUp")
*/
class LineUpController extends AbstractController
{
    /**
     * @Route("/", name="lineUp")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $repo = $this->getDoctrine()->getRepository(LineUp::class);

        $queryLineUp = $repo->findAll();

        $paginationLineUps = $paginator->paginate(
            $queryLineUp, 
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        return $this->render('line_up/index.html.twig', [
            'lineUps' => $queryLineUp,
            'paginationLineUps' => $paginationLineUps
        ]);
    }


    /**
     * @Route("/new", name="lineUp_create")
     * @Route("/{id}/edit", name="lineUp_edit")
     */
    public function form(LineUp $lineUp = null, Request $request, ObjectManager $manager)
    {
        if(!$lineUp){
            $lineUp = new LineUp();
        }

        $form = $this->createForm(LineUpType::class, $lineUp);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$lineUp->getId()){
                $lineUp->setCreatedAt(new \DateTime());
            }

            $manager->persist($lineUp);
            $manager->flush();

            return $this->redirectToRoute('lineUp');

        }

        return $this->render('line_up/create.html.twig', [
            'formLineUp' => $form->createView(),
            'editMode' => $lineUp->getId() !== null
        ]);

    }
}
