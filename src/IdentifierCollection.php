<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\IdentifierRegistry;
use JsonApiPhp\JsonApi\Internal\PrimaryData;
use JsonApiPhp\JsonApi\Internal\ToManyMember;

final class IdentifierCollection implements PrimaryData, ToManyMember
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
