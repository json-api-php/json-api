<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Error\ErrorMember;
use function JsonApiPhp\JsonApi\child;

final class AboutLink implements ErrorMember
{
    use LinkTrait;

    public function attachTo(object $o)
    {
        child($o, 'links')->about = $this->link;
    }
}
