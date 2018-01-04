<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\Member;

abstract class PaginationLink extends Member
{
    public function __construct(Link $link = null)
    {
        parent::__construct($link);
    }
}