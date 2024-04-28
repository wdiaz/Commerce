<?php

namespace App\Factory;

use App\Entity\Merchant;
use Symfony\Component\Uid\UuidV4;
use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<Merchant>
 *
 **/

final class MerchantFactory extends ModelFactory
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
        return [
            'locationX' => self::faker()->randomFloat(),
            'locationY' => self::faker()->randomFloat(),
            'name' => self::faker()->text(255),
            'slug' => self::faker()->text(),
            'uuid' => UuidV4::v4()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Merchant $merchant): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Merchant::class;
    }
}
