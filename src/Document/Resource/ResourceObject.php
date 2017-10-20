<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\LinksTrait;
use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\ReservedName;

class ResourceObject implements \JsonSerializable
{
    use LinksTrait;

    private $type;
    private $id;
    private $meta;
    private $attributes;

    /**
     * @var Relationship[]
     */
    private $relationships;

    public function __construct(string $type, string $id = null)
    {
        $this->type = new ResourceType($type);
        $this->id = $id;
    }

    public function setMeta(Meta $meta)
    {
        $this->meta = $meta;
    }

    public function setAttribute(string $name, $value)
    {
        $name = (string) new ReservedName($name);
        if (isset($this->relationships[$name])) {
            throw new \LogicException("Field '$name' already exists in relationships");
        }
        $this->attributes[$name] = $value;
    }

    public function setRelationship(string $name, Relationship $relationship)
    {
        $name = (string) new ReservedName($name);
        if (isset($this->attributes[$name])) {
            throw new \LogicException("Field '$name' already exists in attributes");
        }
        $this->relationships[$name] = $relationship;
    }

    public function toIdentifier(): ResourceIdentifier
    {
        return new ResourceIdentifier((string) $this->type, $this->id);
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'type' => $this->type,
                'id' => $this->id,
                'attributes' => $this->attributes,
                'relationships' => $this->relationships,
                'links' => $this->links,
                'meta' => $this->meta,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }

    public function identifies(ResourceObject $resource): bool
    {
        if ($this->relationships) {
            foreach ($this->relationships as $relationship) {
                if ($relationship->hasLinkageTo($resource)) {
                    return true;
                }
            }
        }
        return false;
    }
}
