<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface ErrorMember
{
    public function attachTo(object $o);
}
