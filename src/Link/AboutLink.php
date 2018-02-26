<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Error\Member;

final class AboutLink extends AttachableLink implements Member
{
    public function __construct(Link $link)
    {
        parent::__construct('about', $link);
    }
}
