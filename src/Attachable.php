<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

/**
 * @internal
 */
interface Attachable
{
    function attachTo(object $o);
}