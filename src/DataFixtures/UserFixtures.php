<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class UserFixtures extends Fixture
{
    public const NB_USER = 50;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i = 0; $i <= self::NB_USER; $i ++)
        { 
             $user = new User();
             if(!$i)
            {  
                  $user->setEmail("sonia.baptista@hotmail.fr");
                  $user->setRoles(['ROLE_ADMIN']);
            } 
             else
            {
                  $user->setEmail($faker->email());
                  $user->setRoles(['ROLE_USER']);
            }
             $user->setFirstname($faker->firstname());
             $user->setLastname($faker->lastName());
             $user->setNickname($faker->word());
             $user->setPlainPassword("soisy_95");
             $this->addReference("user_". $i, $user);

             $manager->persist($user);

            }
             $manager->flush();
             
        }
    }

