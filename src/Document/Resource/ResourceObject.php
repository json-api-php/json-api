<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\PrimaryData;
use JsonApiPhp\JsonApi\Document\PrimaryDataItem;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Relationship;
use JsonApiPhp\JsonApi\HasLinksAndMeta;

final class ResourceObject implements PrimaryData, PrimaryDataItem
{
    use HasLinksAndMeta;

    private $id;
    private $type;
    private $meta;
    private $links;
    private $attributes;
    private $relationships;

    public function __construct(string $type, string $id = null)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function setAttribute(string $name, $value): void
    {
        if (in_array($name, ['id', 'type'])) {
            throw new \InvalidArgumentException('Invalid attribute name');
        }
        if (isset($this->relationships[$name])) {
            throw new \LogicException("Field $name already exists in relationships");
        }
        $this->attributes[$name] = $value;
    }

    public function setRelationship(string $name, Relationship $relationship): void
    {
        if (isset($this->attributes[$name])) {
            throw new \LogicException("Field $name already exists in attributes");
        }
        $this->relationships[$name] = $relationship;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'type'          => $this->type,
                'id'            => $this->id,
                'attributes'    => $this->attributes,
                'relationships' => $this->relationships,
                'links'         => $this->links,
                'meta'          => $this->meta,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }
}
