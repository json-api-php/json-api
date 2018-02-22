<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\Link\AboutLink;
use JsonApiPhp\JsonApi\Document\Link\Link;
use JsonApiPhp\JsonApi\Document\Link\LinkSet;

class About extends LinkSet implements ErrorMember
{
    public function __construct(Link $link)
    {
        parent::__construct(new AboutLink($link));
    }
}