<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\ToManyMember;
use JsonApiPhp\JsonApi\ToOneMember;
use function JsonApiPhp\JsonApi\child;

final class RelatedLink implements ToOneMember, ToManyMember
{
    use LinkTrait;

    public function attachTo(object $o)
    {
        child($o, 'links')->related = $this->link;
    }
}
