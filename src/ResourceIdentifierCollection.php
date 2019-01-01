<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Collection;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

class ResourceIdentifierCollection implements PrimaryData, Collection
{
    /**
     * @var ResourceIdentifier[]
     */
    private $identifiers = [];

    public function __construct(ResourceIdentifier ...$identifiers)
    {
        $this->identifiers = $identifiers;
    }

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        $o->data = [];
        foreach ($this->identifiers as $identifier) {
            $identifier->attachToCollection($o);
        }
    }

    public function registerIn(array &$registry): void
    {
        foreach ($this->identifiers as $identifier) {
            $identifier->registerIn($registry);
        }
    }
}
