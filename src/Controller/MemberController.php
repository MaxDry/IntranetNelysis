<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use Doctrine\ORM\EntityRepository;
use App\Repository\MemberRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/membres")
*/
class MemberController extends AbstractController
{
    /**
     * @Route("/", name="member")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $repo = $this->getDoctrine()->getRepository(Member::class);
        $membersTest = $this->getDoctrine()
        ->getRepository(Member::class)
        ->findBy([
            'status' => 0,
        ]);

        $members = $repo->findAll();

        $paginationMembers = $paginator->paginate(
            $members, 
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        $paginationMembersTests = $paginator->paginate(
            $membersTest, 
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        return $this->render('member/index.html.twig', [
            'membersTest' => $membersTest,
            'members' => $members,
            'paginationMembers' => $paginationMembers,
            'paginationMembersTest' => $paginationMembersTests
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
     * @Route("/{id}/edit", name="member_edit")
     */
    public function edit(Member $member = null, Request $request, ObjectManager $manager)
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

        return $this->render('member/update.html.twig', [
            'formMember' => $form->createView(),
            'member' => $member,
        ]);

    }

    /**
     * @Route("/new", name="member_create")
     */
    public function create(Member $member = null, Request $request, ObjectManager $manager)
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
            'member' => $member,
        ]);

    }

    /**
     * @Route("/delete", name="member_delete")
     */
    public function delete(Request $request, MemberRepository $repoMember)
    {   
        $id = $request->request->get("value");

        $entityManager = $this->getDoctrine()->getManager();
        $member = $repoMember->findOneById($id);
       
        $entityManager->remove($member);
        $entityManager->flush();

        $data = [
             'result' => true
        ];

        return new JsonResponse($data);
    }
}