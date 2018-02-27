<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class NullData extends AttachableValue implements PrimaryData
{
    public function __construct()
    {
        parent::__construct('data', null);
    }

    public function identifies(ResourceObject $resource): bool
    {
        return false;
    }
}
