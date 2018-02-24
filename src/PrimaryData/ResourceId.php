<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;
use JsonApiPhp\JsonApi\Meta;

class ResourceId extends AttachableValue implements PrimaryData
{
    private $type;
    private $id;

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
        $this->type = $type;
        $this->id = $id;
    }

    public function equals(ResourceId $that): bool
    {
        return $this->type === $that->type && $this->id === $that->id;
    }

    public function identifies(ResourceObject $resource): bool
    {
        return $resource->toResourceId()->equals($this);
    }
}
