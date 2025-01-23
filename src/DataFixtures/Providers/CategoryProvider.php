<?php

namespace App\DataFixtures\Providers;

use Faker\Generator;
use Faker\Provider\Base;
use Symfony\Component\Yaml\Exception\RuntimeException;
use Symfony\Component\Yaml\Yaml;

class CategoryProvider extends Base
{
    private const DIRECTORY = '/config/';
    private const CATEGORIES = 'categories.yml';
    protected static array $categoryNames = [];

    public function __construct(Generator $generator)
    {
        parent::__construct($generator);

        $this->loadCategories();
    }

    private function loadCategories(): void
    {
        if (empty(self::$categoryNames)) {
            if (false === is_readable(__DIR__.self::DIRECTORY.self::CATEGORIES)) {
                throw new RuntimeException(sprintf('%s file is not readable', self::CATEGORIES));
            }
            $categories = Yaml::parseFile(__DIR__.self::DIRECTORY.self::CATEGORIES);
            self::$categoryNames = $categories['categories'];
        }
    }

    protected function generate(): int
    {
        $size = count(self::$categoryNames);

        return rand(0, $size - 1);
    }

    public function category(): array
    {
        static $holder = [];
        $randomIndex = $this->generate();
        do {
            if (in_array($randomIndex, $holder)) {
                $randomIndex = $this->generate();
            }
        } while (in_array($randomIndex, $holder));

        $holder[$randomIndex] = $randomIndex;

        return self::$categoryNames[$randomIndex];
    }

    public function name()
    {
        return $this->generator->randomElements(self::$categoryNames, 1, false)[0]['name'];
    }

    public function description()
    {
        return $this->generator->randomElements(self::$categoryNames)[0]['description'];
    }

    /**
     * @return mixed|null
     */
    public function random()
    {
        return $this->randomElement(self::$categoryNames);
    }
}
