<?php

namespace App\Factory;

use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Invoice>
 *
 * @method        Invoice|Proxy                     create(array|callable $attributes = [])
 * @method static Invoice|Proxy                     createOne(array $attributes = [])
 * @method static Invoice|Proxy                     find(object|array|mixed $criteria)
 * @method static Invoice|Proxy                     findOrCreate(array $attributes)
 * @method static Invoice|Proxy                     first(string $sortedField = 'id')
 * @method static Invoice|Proxy                     last(string $sortedField = 'id')
 * @method static Invoice|Proxy                     random(array $attributes = [])
 * @method static Invoice|Proxy                     randomOrCreate(array $attributes = [])
 * @method static InvoiceRepository|RepositoryProxy repository()
 * @method static Invoice[]|Proxy[]                 all()
 * @method static Invoice[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Invoice[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Invoice[]|Proxy[]                 findBy(array $attributes)
 * @method static Invoice[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Invoice[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class InvoiceFactory extends ModelFactory
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
            'address' => self::faker()->text(255),
            'item' => self::faker()->text(255),
            'ordered_date' => self::faker()->dateTime(),
            'price' => self::faker()->randomFloat(),
            'qty' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Invoice $invoice): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Invoice::class;
    }
}
