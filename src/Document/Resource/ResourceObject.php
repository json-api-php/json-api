<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\Container;
use JsonApiPhp\JsonApi\Document\LinksTrait;
use function JsonApiPhp\JsonApi\filterNulls;
use function JsonApiPhp\JsonApi\isValidMemberName;
use function JsonApiPhp\JsonApi\isValidResourceType;

final class ResourceObject implements \JsonSerializable
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
        if (! isValidResourceType($type)) {
            throw new \OutOfBoundsException("Invalid resource type '$type'");
        }
        $this->type = $type;
        $this->id = $id;
    }

    public function setMeta(iterable $meta)
    {
        $this->meta = new Container($meta);
    }

    public function setAttribute(string $name, $value)
    {
        if ($this->isReservedName($name)) {
            throw new \DomainException("Can not use a reserved name '$name'");
        }
        if (! isValidMemberName($name)) {
            throw new \OutOfBoundsException("Invalid member name '$name'");
        }
        if (isset($this->relationships[$name])) {
            throw new \DomainException("Field '$name' already exists in relationships");
        }
        $this->attributes[$name] = $value;
    }

    public function setRelationship(string $name, Relationship $relationship)
    {
        if ($this->isReservedName($name)) {
            throw new \DomainException("Can not use a reserved name '$name'");
        }
        if (! isValidMemberName($name)) {
            throw new \OutOfBoundsException("Invalid member name '$name'");
        }
        if (isset($this->attributes[$name])) {
            throw new \DomainException("Field '$name' already exists in attributes");
        }
        $this->relationships[$name] = $relationship;
    }

    public function toIdentifier(): ResourceIdentifier
    {
        return new ResourceIdentifier($this->type, $this->id);
    }

    public function jsonSerialize()
    {
        return filterNulls([
            'type' => $this->type,
            'id' => $this->id,
            'attributes' => $this->attributes,
            'relationships' => $this->relationships,
            'links' => $this->links,
            'meta' => $this->meta,
        ]);
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

    private function isReservedName(string $name): bool
    {
        return in_array($name, ['id', 'type']);
    }
}
