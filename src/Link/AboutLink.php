<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Error\ErrorMember;

final class AboutLink extends AttachableLink implements ErrorMember
{
    public function __construct(Link $link)
    {
        parent::__construct('about', $link);
    }
}
