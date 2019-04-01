<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Members;
use App\Repository\MembersRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\MemberType;

class MembersController extends AbstractController
{
    /**
     * @Route("/members", name="members")
     */
    public function index(MembersRepository $repo)
    {

        $members = $repo->findAll();
        return $this->render('members/index.html.twig', [
            'controller_name' => 'MembersController',
            'members' => $members
        ]);
    }


    /**
     * @Route("/members/new", name="member_create")
     */
    public function create(Members $member = null,Request $request, ObjectManager $manager) {
        if(!$member){
            $member = new Members();
        }


        $form = $this->createForm(MemberType::class, $member);

        if($form->isSubmitted() && $form->isValid()){
            if(!$member->getId()){
                $member->setDateStart(new \DateTime());
            }

            $manager->persist($member);
            $manager->flush();
        }

        return $this->render('members/create.html.twig', [
            'formMember' => $form->createView()
        ]);
    }

    /**
     * @Route("/members/{id}", name="members_show")
     */
    public function show(Members $member)
    {
        return $this->render('members/show.html.twig', [
            'member' => $member
        ]);
    }

    

}
