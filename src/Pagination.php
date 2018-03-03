<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\PaginationLink;
use JsonApiPhp\JsonApi\Internal\ToManyMember;

class Pagination implements ToManyMember
{
    /**
     * @var PaginationLink[]
     */
    private $links;

    public function __construct(PaginationLink ...$links)
    {
        $this->links = $links;
    }

    public function attachTo(object $o): void
    {
        foreach ($this->links as $link) {
            $link->attachTo($o);
        }
    }
}
