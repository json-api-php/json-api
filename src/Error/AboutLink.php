<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Link\Link;
use JsonApiPhp\JsonApi\Link\AttachableLink;

final class AboutLink extends AttachableLink implements ErrorMember
{
    public function __construct(Link $link)
    {
        parent::__construct('about', $link);
    }
}