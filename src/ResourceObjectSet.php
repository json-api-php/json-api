<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class ResourceObjectSet implements PrimaryData
{
    /**
     * @var ResourceObject[]
     */
    private $resources;

    public function __construct(ResourceObject ...$resources)
    {
        $this->resources = $resources;
    }

    public function identifies(ResourceObject $resource): bool
    {
        foreach ($this->resources as $myResource) {
            if ($myResource->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    public function attachTo(object $o)
    {
        $o->data = $this->resources;
    }
}
