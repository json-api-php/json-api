<?php
/**
 *  This file is part of JSON:API implementation for PHP.
 *
 *  (c) Alexey Karapetov <karapetov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\Resource\Relationship\Relationship;
use JsonApiPhp\JsonApi\HasLinksAndMeta;

final class ResourceObject extends IdentifiableResource
{
    use HasLinksAndMeta;

    private $meta;
    private $links;
    private $attributes;
    private $relationships;

    public function __construct(string $type, string $id = null)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function setAttribute(string $name, $value)
    {
        if (in_array($name, ['id', 'type'])) {
            throw new \InvalidArgumentException('Invalid attribute name');
        }
        if (isset($this->relationships[$name])) {
            throw new \LogicException("Field $name already exists in relationships");
        }
        $this->attributes[$name] = $value;
    }

    public function setRelationship(string $name, Relationship $relationship)
    {
        if (isset($this->attributes[$name])) {
            throw new \LogicException("Field $name already exists in attributes");
        }
        $this->relationships[$name] = $relationship;
    }

    public function toId(): ResourceId
    {
        return new ResourceId($this->type, $this->id);
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

    public function identifies(IdentifiableResource $that): bool
    {
        return $this->isEqualTo($that) || $this->isRelatedTo($that);
    }

    private function isRelatedTo(IdentifiableResource $resource): bool
    {
        if ($this->relationships) {
            /** @var Relationship $relationship */
            foreach ($this->relationships as $relationship) {
                if ($relationship->hasLinkageTo($resource)) {
                    return true;
                }
            }
        }
        return false;
    }
}
