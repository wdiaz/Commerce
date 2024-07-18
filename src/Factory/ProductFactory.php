<?php

namespace App\Factory;

use App\Entity\Product;
use Faker\Factory;
use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<Product>
 */
final class ProductFactory extends ModelFactory
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
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
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
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Product $product): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Product::class;
    }
}
