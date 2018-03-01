<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\LinkTrait;
use function JsonApiPhp\JsonApi\child;

final class NextLink implements DataDocumentMember
{
    use LinkTrait;

    public function attachTo(object $o)
    {
        child($o, 'links')->next = $this->link;
    }
}
