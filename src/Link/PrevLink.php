<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\ToOneMember;
use function JsonApiPhp\JsonApi\child;

final class PrevLink implements DataDocumentMember, ToOneMember
{
    use LinkTrait;

    public function attachTo(object $o)
    {
        child($o, 'links')->prev = $this->link;
    }
}
