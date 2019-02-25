<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use function JsonApiPhp\JsonApi\child;
use JsonApiPhp\JsonApi\Internal\LinkTrait;
use JsonApiPhp\JsonApi\Internal\PaginationLink;

final class PrevLink implements PaginationLink
{
    use LinkTrait;

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        child($o, 'links')->prev = $this->link;
    }
}
