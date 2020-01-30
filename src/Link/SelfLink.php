<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use function JsonApiPhp\JsonApi\child;
use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\LinkTrait;
use JsonApiPhp\JsonApi\Internal\RelationshipMember;
use JsonApiPhp\JsonApi\Internal\ResourceMember;
use JsonApiPhp\JsonApi\Internal\PaginationLink;

final class SelfLink implements DataDocumentMember, ResourceMember, RelationshipMember, PaginationLink
{
    use LinkTrait;

    /**
     * @param object $o
     * @internal
     */
    public function attachTo($o): void
    {
        child($o, 'links')->self = $this->link;
    }
}
