<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface Attachable
{
    public function attachTo(object $o);
}
