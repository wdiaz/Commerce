<?php

namespace App\Factory;

use App\Entity\Product;
use Faker\Factory;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 *
 */
final class ProductFactory extends PersistentObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public static function class(): string
    {
        return Product::class;
    }

    /**
     * @return array|callable
     */
    protected function defaults(): array|callable
    {
        $faker = Factory::create();
        $faker->addProvider(new CustomProvider($faker));
        $product = $faker->product();

        return [
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'name' => $product['name'], // $faker->name(),
            'sku' => $product['sku'], // self::faker()->randomNumber(5),
            'long_description' => $product['description'], // $faker->description(),
            'merchant' => MerchantFactory::createOne(),
            'price' => $product['price'],
            'main_image' => $product['main_image'],
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     *
     * @return $this
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Product $product): void {})
        ;
    }
}
