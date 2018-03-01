<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\FieldRegistry;
use JsonApiPhp\JsonApi\Internal\IdentifierRegistry;
use JsonApiPhp\JsonApi\Internal\LinkTrait;
use JsonApiPhp\JsonApi\Internal\ResourceMember;
use JsonApiPhp\JsonApi\Internal\ToManyMember;
use JsonApiPhp\JsonApi\Internal\ToOneMember;
use function JsonApiPhp\JsonApi\child;

final class SelfLink implements DataDocumentMember, ResourceMember, ToOneMember, ToManyMember
{
    use LinkTrait;

    public function attachTo(object $o): void
    {
        child($o, 'links')->self = $this->link;
    }

    public function registerField(FieldRegistry $registry)
    {
    }

    public function registerIdentifier(IdentifierRegistry $registry)
    {
    }

    public function attachToCollection(object $o)
    {
        // TODO: Implement attachToCollection() method.
    }
}
