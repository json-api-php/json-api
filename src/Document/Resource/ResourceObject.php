<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\LinksTrait;
use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Relationship;

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
        $this->type = $type;
        $this->id = $id;
    }

    public function setMeta(Meta $meta)
    {
        $this->meta = $meta;
    }

    public function setAttribute(string $name, $value)
    {
        if ($this->isReservedName($name)) {
            throw new \InvalidArgumentException('Can not use a reserved name');
        }
        if (!$this->isValidMemberName($name)) {
            throw new \OutOfBoundsException('Not a valid attribute name');
        }
        if (isset($this->relationships[$name])) {
            throw new \LogicException("Field $name already exists in relationships");
        }
        $this->attributes[$name] = $value;
    }

    public function setRelationship(string $name, Relationship $relationship)
    {
        if ($this->isReservedName($name)) {
            throw new \InvalidArgumentException('Can not use a reserved name');
        }
        if (isset($this->attributes[$name])) {
            throw new \LogicException("Field $name already exists in attributes");
        }
        $this->relationships[$name] = $relationship;
    }

    public function toIdentifier(): ResourceIdentifier
    {
        return new ResourceIdentifier($this->type, $this->id);
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

    private function isReservedName(string $name): bool
    {
        return in_array($name, ['id', 'type']);
    }

    private function isValidMemberName(string $name): bool
    {
        return preg_match('/^(?=[^-_ ])[a-zA-Z0-9\x{0080}-\x{FFFF}-_ ]*(?<=[^-_ ])$/u', $name) === 1;
    }
}
