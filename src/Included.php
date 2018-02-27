<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

final class Included extends AttachableValue implements DataDocumentMember, \IteratorAggregate
{
    private $resources = [];

    public function __construct(ResourceObject ...$resources)
    {
        foreach ($resources as $resource) {
            $string_id = json_encode($resource->identifier());
            if (isset($this->resources[$string_id])) {
                throw new \LogicException("Resource $string_id is already included");
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
