<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;

final class EmptySet extends AttachableValue implements PrimaryData
{
    public function __construct()
    {
        parent::__construct('data', []);
    }

    public function identifies(ResourceObject $resource): bool
    {
        return false;
    }
}
