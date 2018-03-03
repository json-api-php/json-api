<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Internal\LinkTrait;
use JsonApiPhp\JsonApi\Internal\ToOneMember;
use function JsonApiPhp\JsonApi\child;

final class RelatedLink implements ToOneMember
{
    use LinkTrait;

    public function attachTo(object $o): void
    {
        child($o, 'links')->related = $this->link;
    }
}
