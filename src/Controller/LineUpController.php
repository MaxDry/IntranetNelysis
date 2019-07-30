<?php

namespace App\Controller;

use App\Entity\LineUp;
use App\Entity\Member;
use App\Form\LineUpType;
use App\Repository\LineUpRepository;

use App\Repository\MemberRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/{id}/edit", name="lineUp_edit")
     */
    public function edit(LineUp $lineUp = null, Request $request, ObjectManager $manager, MemberRepository $repo)
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

        return $this->render('line_up/update.html.twig', [
            'formLineUp' => $form->createView(),
            'lineUp' => $lineUp,
        ]);

    }


    /**
     * @Route("/new", name="lineUp_create")
     */
    public function create(LineUp $lineUp = null, Request $request, ObjectManager $manager, MemberRepository $repo)
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
            'lineUp' => $lineUp,
        ]);

    }


    /**
     * @Route("/delete", name="lineUp_delete")
     */
    public function delete(Request $request, MemberRepository $repoMember, LineUpRepository $repoLineUp)
    {   
        $id = $request->request->get("value");

        
        $entityManager = $this->getDoctrine()->getManager();
        $lineUp = $repoLineUp->findOneById($id);
      
        $members = $repoMember->findall();

        // dump($members);

        
        foreach($members as $member){
            if($member->getLineUp() != null)
                if($member->getLineUp()->getId() == $id){
                    $member->setLineUp(null);
                }
        }

        $entityManager->remove($lineUp);
        $entityManager->flush();

        $data = [
             'result' => true
        ];

        return new JsonResponse($data);
    }
}
