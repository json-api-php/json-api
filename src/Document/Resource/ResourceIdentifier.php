<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\Meta;

class ResourceIdentifier implements \JsonSerializable
{
    private $type;
    private $id;
    private $meta;

    public function __construct(string $type, string $id, Meta $meta = null)
    {
        $this->type = $type;
        $this->id = $id;
        $this->meta = $meta;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'type' => $this->type,
                'id' => $this->id,
                'meta' => $this->meta,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }

    public function identifies(ResourceObject $resource): bool
    {
        return $resource->toIdentifier()->equals($this);
    }

    public function __toString(): string
    {
        return "$this->type:$this->id";
    }

    private function equals(ResourceIdentifier $that)
    {
        return $this->type === $that->type && $this->id === $that->id;
    }
}
