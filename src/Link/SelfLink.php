<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMemberTrait;
use JsonApiPhp\JsonApi\ToManyMember;
use JsonApiPhp\JsonApi\ToOneMember;
use function JsonApiPhp\JsonApi\child;

final class SelfLink implements DataDocumentMember, ResourceMember, ToOneMember, ToManyMember
{
    use ResourceMemberTrait, LinkTrait;

    public function attachTo(object $o): void
    {
        child($o, 'links')->self = $this->link;
    }
}
