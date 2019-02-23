<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use function JsonApiPhp\JsonApi\child;
use JsonApiPhp\JsonApi\Internal\ErrorMember;
use JsonApiPhp\JsonApi\Internal\LinkTrait;

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
