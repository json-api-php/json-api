<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\DocumentMember;

abstract class PaginationLink extends DocumentMember
{
    public function __construct(Link $link = null)
    {
        parent::__construct($link);
    }
}