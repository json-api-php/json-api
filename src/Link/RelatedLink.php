<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Internal\LinkTrait;
use JsonApiPhp\JsonApi\Internal\RelationshipMember;
use function JsonApiPhp\JsonApi\child;

final class RelatedLink implements RelationshipMember
{
    use LinkTrait;

    public function attachTo(object $o)
    {
        child($o, 'links')->related = $this->link;
    }
}
