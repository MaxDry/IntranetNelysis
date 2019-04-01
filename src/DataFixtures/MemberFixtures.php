<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Members;

class MemberFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $member = new Members();
            $member->setName("Prénom n°$i")
                   ->setAge($i)
                   ->setPseudo("Pseudo n°$i")
                   ->setAmbitions("Ambitions n°$i")
                   ->setOldTeams("ancienne team n°$i")
                   ->setMainGame("jeu principal n°$i")
                   ->setWhyUs("pouruoi nous n°$i")
                   ->setStatus("statut n°$i")
                   ->setDateStart(new \DateTime());

            $manager->persist($member);
        }

        $manager->flush();

        $manager->flush();
    }
}
