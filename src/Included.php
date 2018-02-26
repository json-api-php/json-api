<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;

final class Included extends AttachableValue implements DataDocumentMember, \IteratorAggregate
{
    private $resources = [];

    public function __construct(ResourceObject ...$resources)
    {
        foreach ($resources as $resource) {
            $string_id = (string) $resource;
            if (isset($this->resources[$string_id])) {
                throw new \DomainException("Resource $resource is already included");
            }
            $this->resources[$string_id] = $resource;
        }
        parent::__construct('included', $resources);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->resources);
    }
}
