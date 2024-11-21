<?php

namespace App\Factory;

use Faker\Generator;
use Faker\Provider\Base;
use Symfony\Component\Yaml\Exception\RuntimeException;
use Symfony\Component\Yaml\Yaml;

class CustomProvider extends Base
{
    private const DIRECTORY = '/config/';
    private const PRODUCTS = 'products.yml';
    protected static array $departments = ['Books', 'Movies', 'Music', 'Games', 'Electronics', 'Computers', 'Home', 'Garden', 'Tools', 'Grocery', 'Health', 'Beauty', 'Toys', 'Kids', 'Baby', 'Clothing', 'Shoes', 'Jewelry', 'Sports', 'Outdoors', 'Automotive', 'Industrial'];

    protected static array $productNames = [];

    public function __construct(Generator $generator)
    {
        parent::__construct($generator);

        $this->loadProducts();
    }

    private function loadProducts(): void
    {
        if (empty(self::$productNames)) {
            if (false === is_readable(__DIR__.self::DIRECTORY.self::PRODUCTS)) {
                throw new RuntimeException(sprintf('%s file is not readable', self::PRODUCTS));
            }
            $products = Yaml::parseFile(__DIR__.self::DIRECTORY.self::PRODUCTS);
            self::$productNames = $products['products'];
        }
    }

    protected function generate()
    {
        $size = count(self::$productNames);

        return rand(0, $size - 1);
    }

    public function product(): array
    {
        static $holder = [];
        $randomIndex = $this->generate();
        do {
            if (in_array($randomIndex, $holder)) {
                $randomIndex = $this->generate();
            }
        } while (in_array($randomIndex, $holder));

        $holder[$randomIndex] = $randomIndex;

        return self::$productNames[$randomIndex];
    }

    public function name()
    {
        return $this->generator->randomElements(self::$productNames, 1, false)[0]['name'];
    }

    public function description()
    {
        return $this->generator->randomElements(self::$productNames)[0]['description'];
    }

    public function category()
    {
        return $this->randomElement(self::$departments);
    }
}
