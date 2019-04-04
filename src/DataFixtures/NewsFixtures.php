<?php
namespace App\DataFixtures;

use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class NewsFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 7; $i++) {
            $news = new News();
            $news->setTitle($faker->sentence($nbWords = 2, $variableNbWords = true));
            $news->setDescription($faker->text($maxNbChars = 100));
            $news->setCreatedAt(new \DateTime());
            $news->setUpdatedAt(new \DateTime());

            $manager->persist($news);
        }

        $manager->flush();
    }
}