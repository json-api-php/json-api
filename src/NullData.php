<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class NullData implements PrimaryData
{
    public function identifies(ResourceObject $resource): bool
    {
        return false;
    }

    public function attachTo(object $o)
    {
        $o->data = null;
    }
}
