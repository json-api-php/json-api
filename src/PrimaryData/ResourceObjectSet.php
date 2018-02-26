<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;

final class ResourceObjectSet extends AttachableValue implements PrimaryData
{
    /**
     * @var ResourceObject[]
     */
    private $resources;

    public function __construct(ResourceObject ...$resources)
    {
        $this->resources = $resources;
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
