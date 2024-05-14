<?php

namespace App\DataFixtures;

use App\Factory\MerchantFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MerchantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = MerchantFactory::createMany(10);
        $manager->flush();
    }
}
