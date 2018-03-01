<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

/**
 * @internal
 */
interface ErrorMember
{
    public function attachTo(object $o);
}
