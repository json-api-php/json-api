<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\LinkTrait;
use JsonApiPhp\JsonApi\Internal\ResourceMember;
use JsonApiPhp\JsonApi\Internal\ToOneMember;
use function JsonApiPhp\JsonApi\child;

final class SelfLink implements DataDocumentMember, ResourceMember, ToOneMember
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
