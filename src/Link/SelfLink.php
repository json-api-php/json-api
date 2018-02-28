<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\RelationshipMember;
use function JsonApiPhp\JsonApi\child;

final class SelfLink implements DataDocumentMember, ResourceMember, RelationshipMember
{
    /**
     * @var Link
     */
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function attachTo(object $o)
    {
        child($o, 'links')->self = $this->link;
    }
}
