<?php
namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MemberFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(12, "Member", function ($count) {
            $members = new Member();
            $members->setFirstName($this->faker->name);
            $members->setPseudo($this->faker->lastName);
            $members->setAge($this->faker->numberBetween($min = 10, $max = 40));
            $members->setGoal($this->faker->text($maxNbChars = 100));
            $members->setMainGame($this->faker->randomElement($array = array ('CSGO','Overwatch','Fortnite')));
            $members->setEmail($this->faker->freeEmail);
            $members->setLastTeam($this->faker->randomElement($array = array ('Milenium','Alliance','Epsilon','3DMAX','aAa')));
            $members->setWhyUs($this->faker->text($maxNbChars = 100));
            $members->setCreatedAt(new \DateTime());
            $members->setUpdatedAt(new \DateTime());
            $members->setLastTeam($this->faker->name);
            $members->setDiscord($this->faker->url);
            $members->setStatus($this->faker->boolean);
            $members->setLineUp($this->getRandomReference("LineUp"));

            return $members;
        });

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            LineUpFixtures::class
        ];
    }
}