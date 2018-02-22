<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;

final class NullData extends AttachableValue implements PrimaryData
{
    public function __construct()
    {
        parent::__construct('data', null);
    }
}
