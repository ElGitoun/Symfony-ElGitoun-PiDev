<?php

namespace App\DataFixtures;

use App\Entity\PublicationForum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PublicationEquipement extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker =Fact::create();
        for ($i = 0 ;$i<100 ;$i++){
            $publicationforum=new PublicationForum();
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
