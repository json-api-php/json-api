<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Internal\ErrorMember;
use JsonApiPhp\JsonApi\Internal\LinkTrait;
use function JsonApiPhp\JsonApi\child;

final class AboutLink implements ErrorMember
{
    use LinkTrait;

    public function attachTo(object $o): void
    {
        child($o, 'links')->about = $this->link;
    }
}
