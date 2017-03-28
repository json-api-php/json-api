<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\PrimaryData;

final class NullData implements PrimaryData
{
    public function jsonSerialize()
    {
        return null;
    }
}
