<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Internal\ErrorMember;
use JsonApiPhp\JsonApi\Internal\LinkTrait;
use function JsonApiPhp\JsonApi\child;

final class AboutLink implements ErrorMember
{
    use LinkTrait;

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        child($o, 'links')->about = $this->link;
    }
}
