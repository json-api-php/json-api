<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;

final class ResourceObjectSet extends AttachableValue implements PrimaryData
{
    /**
     * @var ResourceObject[]
     */
    private $resources;

    public function __construct(ResourceObject $resource, ResourceObject ...$resources)
    {
        $this->resources = func_get_args();
        parent::__construct('data', $this->resources);
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
}
