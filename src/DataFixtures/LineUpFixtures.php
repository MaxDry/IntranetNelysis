<?php
namespace App\DataFixtures;

use App\Entity\LineUp;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LineUpFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 7; $i++) {
            $lineUp = new LineUp();
            $lineUp->setName($faker->randomElement($array = array ('Milenium','Alliance','Epsilon','3DMAX','aAa')));
            $lineUp->setGame($faker->randomElement($array = array ('CSGO','Overwatch','Fortnite')));
            $lineUp->setCreatedAt(new \DateTime());
            $manager->persist($lineUp);
        }

        $manager->flush();
    }
}