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

use JsonApiPhp\JsonApi\Document\LinksTrait;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Relationship;

class ResourceObject extends ResourceIdentifier
{
    use LinksTrait;

    private $attributes;
    private $relationships;

    public function setAttribute(string $name, $value)
    {
        if ($this->isReservedName($name)) {
            throw new \InvalidArgumentException('Can not use a reserved name');
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

    public function toId(): ResourceIdentifier
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

    public function identifies(ResourceInterface $resource): bool
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

    /**
     * @param string $name
     * @return bool
     */
    private function isReservedName(string $name): bool
    {
        return in_array($name, ['id', 'type']);
    }
}
