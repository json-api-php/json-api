<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class NullData implements PrimaryData
{
    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        $o->data = null;
    }

    public function registerIn(array &$registry): void
    {
    }
}
