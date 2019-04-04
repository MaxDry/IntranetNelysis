<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Member;

class MemberController extends AbstractController
{
    /**
     * @Route("/members", name="member")
     */
    public function index()
    {

        $repo = $this->getDoctrine()->getRepository(Member::class);

        $members = $repo->findAll();

        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
            'members' => $members
        ]);
    }
}
