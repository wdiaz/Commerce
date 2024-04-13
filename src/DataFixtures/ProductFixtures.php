<?php

namespace App\DataFixtures;

use App\Factory\ProductFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Load products onto the database
 */
class ProductFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $product = ProductFactory::createMany(10);
        $manager->flush();
    }
}
