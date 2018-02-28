<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class ResourceIdentifier implements PrimaryData, ToManyMember
{
    private $type;
    private $id;
    private $identifier;

    public function __construct(string $type, string $id, Meta $meta = null)
    {
        $this->identifier = (object) [
            'type' => $type,
            'id' => $id,
        ];
        if ($meta) {
            $meta->attachTo($this->identifier);
        }
        $this->type = $type;
        $this->id = $id;
    }

    public function identifies(ResourceObject $resource): bool
    {
        return $resource->identifier()->equals($this);
    }

    public function equals(ResourceIdentifier $that): bool
    {
        return $this->type === $that->type && $this->id === $that->id;
    }

    public function attachTo(object $o)
    {
        $o->data = $this->identifier;
    }

    public function attachToCollection(object $o): void
    {
        $o->data[] = $this->identifier;
    }
}
