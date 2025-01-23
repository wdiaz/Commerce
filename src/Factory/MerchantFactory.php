<?php

namespace App\Factory;

use App\Entity\Merchant;
use Symfony\Component\Uid\UuidV4;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends ModelFactory<Merchant>
 *
 **/
final class MerchantFactory extends PersistentObjectFactory
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

    public static function class(): string
    {
        return Merchant::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Merchant $merchant): void {})
        ;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     */
    protected function defaults(): array|callable
    {
        return [
            'locationX' => self::faker()->randomFloat(),
            'locationY' => self::faker()->randomFloat(),
            'name' => self::faker()->text(50),
            'uuid' => UuidV4::v4(),
        ];
    }
}
