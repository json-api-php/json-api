<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class EmptySet extends AttachableValue implements PrimaryData
{
    public function __construct()
    {
        parent::__construct('data', []);
    }
}
