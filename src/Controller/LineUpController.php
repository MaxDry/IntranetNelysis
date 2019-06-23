<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\LineUp;
use App\Repository\LineUpRepository;
use App\Form\LineUpType;
/**
* @Route("/lineUp")
*/
class LineUpController extends AbstractController
{
    /**
     * @Route("/", name="lineUp")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(LineUp::class);

        $lineUp = $repo->findAll();

        return $this->render('line_up/index.html.twig', [
            'lineUps' => $lineUp
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
