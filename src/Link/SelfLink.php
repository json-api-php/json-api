<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use function JsonApiPhp\JsonApi\child;
use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\LinkTrait;
use JsonApiPhp\JsonApi\Internal\RelationshipMember;
use JsonApiPhp\JsonApi\Internal\ResourceMember;

final class SelfLink implements DataDocumentMember, ResourceMember, RelationshipMember
{
    use LinkTrait;

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        child($o, 'links')->self = $this->link;
    }
}
