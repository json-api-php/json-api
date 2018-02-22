<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;
use JsonApiPhp\JsonApi\Meta;

class ResourceId extends AttachableValue implements PrimaryData
{
    public function __construct(string $type, string $id, Meta $meta = null)
    {
        $identifier = (object) [
            'type' => $type,
            'id' => $id,
        ];
        if ($meta) {
            $meta->attachTo($identifier);
        }
        parent::__construct('data', $identifier);
    }
}
