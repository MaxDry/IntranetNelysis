<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture 
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 7; $i++) {
            $user = new User();
            $user->setFirstName($faker->name);
            $user->setPseudo($faker->lastName);
            $user->setAge($faker->numberBetween($min = 10, $max = 40));
            $user->setEmail($faker->freeEmail);
            $user->setPassword("azerty");
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());
            $user->setProfile($faker->sentence($nbWords = 2, $variableNbWords = true));

            $manager->persist($user);
        }

        $manager->flush();
    }
}