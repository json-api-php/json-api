<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use function JsonApiPhp\JsonApi\child;
use JsonApiPhp\JsonApi\Internal\LinkTrait;
use JsonApiPhp\JsonApi\Internal\RelationshipMember;

final class RelatedLink implements RelationshipMember
{
    use LinkTrait;

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        child($o, 'links')->related = $this->link;
    }
}
