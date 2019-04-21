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
        $this->faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 7; $i++) {
            $user = new User();
            $user->setFirstName($this->faker->name);
            $user->setPseudo($this->faker->lastName);
            $user->setAge($this->faker->numberBetween($min = 10, $max = 40));
            $user->setEmail($this->faker->freeEmail);
            $user->setPassword($this->passwordEncoder->encodePassword($user, "azerty"));
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());
            $user->setProfile($this->faker->sentence($nbWords = 2, $variableNbWords = true));
            $user->setRoles($this->faker->randomElement($array = array(["ROLE_FONDATEUR"], ["ROLE_ADMIN"], ["ROLE_MODERATEUR"])));
            $manager->persist($user);
        }

        $manager->flush();
    }
}