<?php
namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class TaskFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 7; $i++) {
            $task = new Task();
            $task->setTitle($faker->sentence($nbWords = 2, $variableNbWords = true));
            $task->setDescription($faker->text($maxNbChars = 100));
            $task->setCreatedAt(new \DateTime());
            $task->setUpdatedAt(new \DateTime());
            $task->setStatus($faker->boolean);

            $manager->persist($task);
        }

        $manager->flush();
    }
}