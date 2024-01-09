<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Program;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        
        for($i = 0; $i <= 49; $i++)
        {
            $program = new Program();
            $program->setCity($faker->city());
            $program->setName($faker->lastName());
            $program->setDescription($faker->word());
            $program->setCreatedAt(new \DateTimeImmutable("NOW"));
            $program->setJourneyOfReservation(new \DateTime("NOW"));
            $program->setUser($this->getReference("user_" . rand(0, UserFixtures::NB_USER - 1)));
            $program->setBand($this->getReference("band_" . $i));
            $manager->persist($program);
        }
            $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            BandFixtures::class
        ];

    }
}