<?php
namespace App\DataFixtures;

use App\Entity\LineUp;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LineUpFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "LineUp", function ($count) {
            $lineUp = new LineUp();
            $lineUp->setName($this->faker->randomElement($array = array ('Milenium','Alliance','Epsilon','3DMAX','aAa')));
            $lineUp->setGame($this->faker->randomElement($array = array ('CSGO','Overwatch','Fortnite')));
            $lineUp->setCreatedAt(new \DateTime());
            return $lineUp;
        });

        $manager->flush();
    }
}