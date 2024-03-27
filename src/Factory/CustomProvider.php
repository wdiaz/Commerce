<?php

namespace App\Factory;

use Faker\Provider\Base;
use Faker\Generator;
use Symfony\Component\Yaml\Exception\RuntimeException;
use Symfony\Component\Yaml\Yaml;

class CustomProvider extends Base
{

    private const DIRECTORY = '/config/';
    private const PRODUCTS = 'products.yml';
    protected static array $departments = ["Books", "Movies", "Music", "Games", "Electronics", "Computers", "Home", "Garden", "Tools", "Grocery", "Health", "Beauty", "Toys", "Kids", "Baby", "Clothing", "Shoes", "Jewelry", "Sports", "Outdoors", "Automotive", "Industrial"];


    protected static array $productNames = [];

    /*protected static $productNames = [
        'adjective' => ['Small', 'Ergonomic', 'Rustic', 'Intelligent', 'Gorgeous', 'Incredible', 'Fantastic', 'Practical', 'Sleek', 'Awesome', 'Enormous', 'Mediocre', 'Synergistic', 'Heavy Duty', 'Lightweight', 'Aerodynamic', 'Durable'],
        'material' => ['Steel', 'Wooden', 'Concrete', 'Plastic', 'Cotton', 'Granite', 'Rubber', 'Leather', 'Silk', 'Wool', 'Linen', 'Marble', 'Iron', 'Bronze', 'Copper', 'Aluminum', 'Paper'],
        'product' => ['Chair', 'Car', 'Computer', 'Gloves', 'Pants', 'Shirt', 'Table', 'Shoes', 'Hat', 'Plate', 'Knife', 'Bottle', 'Coat', 'Lamp', 'Keyboard', 'Bag', 'Bench', 'Clock', 'Watch', 'Wallet'],
    ];*/

    public function __construct(Generator $generator)
    {
        parent::__construct($generator);

        $this->loadProducts();
    }

    private function loadProducts(): void
    {
        if(empty(self::$productNames)) {
            if(false === is_readable(__DIR__ . self::DIRECTORY . self::PRODUCTS )) {
                throw new RuntimeException(sprintf("%s file is not readable", self::PRODUCTS));
            }
            $products = Yaml::parseFile(__DIR__ . self::DIRECTORY . self::PRODUCTS );
            self::$productNames = $products['products'];
        }
    }


    public function product()
    {

    }

    public function name()
    {
        return $this->generator->randomElements(self::$productNames,1, false)[0]['name'];
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