<?php
namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class MemberFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $member = new Member();
            $member->setFirstName($faker->name);
            $member->setPseudo($faker->lastName);
            $member->setAge($faker->numberBetween($min = 10, $max = 40));
            $member->setGoal($faker->text($maxNbChars = 100));
            $member->setMainGame($faker->randomElement($array = array ('CSGO','Overwatch','Fortnite')));
            $member->setEmail($faker->freeEmail);
            $member->setLastTeam($faker->randomElement($array = array ('Milenium','Alliance','Epsilon','3DMAX','aAa')));
            $member->setWhyUs($faker->text($maxNbChars = 100));
            $member->setCreatedAt(new \DateTime());
            $member->setUpdatedAt(new \DateTime());
            $member->setLastTeam($faker->name);
            $member->setDiscord($faker->url);
            $member->setStatus($faker->boolean);
            // $member->setLineUp($faker->getRandomReference("LineUp"));
            $manager->persist($member);
        }

        $manager->flush();
    }
}