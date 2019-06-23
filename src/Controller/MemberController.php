<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;
use App\Entity\Member;
use App\Repository\MemberRepository;
use App\Form\MemberType;

/**
* @Route("/membres")
*/
class MemberController extends AbstractController
{
    /**
     * @Route("/", name="member")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Member::class);
        $membersTest = $this->getDoctrine()
        ->getRepository(Member::class)
        ->findBy([
            'status' => 0,
        ]);

        $members = $repo->findAll();

        return $this->render('member/index.html.twig', [
            'membersTest' => $membersTest,
            'controller_name' => 'MemberController',
            'members' => $members
        ]);
    }

    /**
     * @Route("/test", name="members_test", methods={"GET"})
     */
    public function get_members_test(): Response
    {
        $repo = $this->getDoctrine()
        ->getRepository(Member::class);


        // $membersTest = $this->getDoctrine()
        // ->getRepository(Member::class)
        // ->getMembersTestByStatus('0');

        $membersTest = $this->getDoctrine()
        ->getRepository(Member::class)
        ->findBy([
            'status' => 0,
        ]);


        return $this->render('member/members_test.html.twig', [
            'membersTest' => $membersTest
        ]);
    }


    /**
     * @Route("/new", name="member_create")
     * @Route("/{id}/edit", name="member_edit")
     */
    public function form(Member $member = null, Request $request, ObjectManager $manager)
    {
        if(!$member){
            $member = new Member();
        }

        $form = $this->createForm(MemberType::class, $member);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$member->getId()){
                $member->setCreatedAt(new \DateTime());
                $member->setStatus(0);
            }

            $manager->persist($member);
            $manager->flush();

            return $this->redirectToRoute('member');

        }

        return $this->render('member/create.html.twig', [
            'formMember' => $form->createView(),
            'editMode' => $member->getId() !== null
        ]);

    }
}