<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

final class Included implements DataDocumentMember, \IteratorAggregate
{
    private $resources = [];

    public function __construct(ResourceObject ...$resources)
    {
        foreach ($resources as $resource) {
            $string_id = $resource->uniqueId();
            if (isset($this->resources[$string_id])) {
                throw new \LogicException("Resource $string_id is already included");
            }
            $this->resources[$string_id] = $resource;
        }
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->resources);
    }

    public function attachTo(object $o)
    {
        $o->included = array_values($this->resources);
    }
}
