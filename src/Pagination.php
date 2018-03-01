<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Attachable;
use JsonApiPhp\JsonApi\Internal\PaginationLink;

class Pagination implements Attachable
{
    /**
     * @var PaginationLink[]
     */
    private $links;

    public function __construct(PaginationLink ...$links)
    {
        $this->links = $links;
    }

    public function attachTo(object $o)
    {
        foreach ($this->links as $link) {
            $link->attachTo($o);
        }
    }
}
