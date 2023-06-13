<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Band;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BandFixtures extends Fixture implements DependentFixtureInterface
{
    public const NB_BAND = 50;
    public function load(ObjectManager $manager): void
    {
        
         $faker = Factory::create();

         for($i = 0; $i <= self::NB_BAND; $i++)
         {
            $band = new Band();
            $band->setName($faker->lastName());
            $band->setMusicalStyle($faker->name());
            $band->setPicture($faker->imageUrl());
            $band->setDescription($faker->word());
            $band->setUserId($this->getReference("user_" . $i));
            $manager->persist($band);
         }
         $manager->flush();
    }

     public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

}
