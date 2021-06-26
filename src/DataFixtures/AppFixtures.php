<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Phone;
use Faker;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 10; $i++) {
          $phone = new Phone();
          $phone->setMarque($faker->name())
                ->setCodeImei('1234566')
                ->setNom($faker->name)
                ->setCouleur($faker->colorName)
                ->setStockage(16);
          $manager->persist($phone);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
