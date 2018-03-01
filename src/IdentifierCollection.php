<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

final class IdentifierCollection implements PrimaryData
{
    /**
     * @var ResourceIdentifier[]
     */
    private $identifiers = [];

    public function __construct(ResourceIdentifier ...$identifiers)
    {
        $this->identifiers = $identifiers;
    }

    public function attachTo(object $o)
    {
        $o->data = [];
        foreach ($this->identifiers as $identifier) {
            $identifier->attachToCollection($o);
        }
    }

    public function registerIn(IdentifierRegistry $registry)
    {
        foreach ($this->identifiers as $identifier) {
            $identifier->registerIn($registry);
        }
    }
}
