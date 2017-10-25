<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\Container;
use function JsonApiPhp\JsonApi\filterNulls;
use function JsonApiPhp\JsonApi\isValidResourceType;

final class ResourceIdentifier implements \JsonSerializable
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $id;

    private $meta;

    public function __construct(string $type, string $id, iterable $meta = null)
    {
        if (! isValidResourceType($type)) {
            throw new \OutOfBoundsException("Invalid resource type '$type'");
        }
        $this->type = $type;
        $this->id = $id;
        if ($meta) {
            $this->meta = new Container($meta);
        }
    }

    public function jsonSerialize()
    {
        return filterNulls([
            'type' => $this->type,
            'id' => $this->id,
            'meta' => $this->meta,
        ]);
    }

    public function identifies(ResourceObject $resource): bool
    {
        return $resource->toIdentifier()->equals($this);
    }

    private function equals(ResourceIdentifier $that)
    {
        return $this->type === $that->type && $this->id === $that->id;
    }

    public function __toString(): string
    {
        return "$this->type:$this->id";
    }
}
