<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;

final class ResourceSet extends AttachableValue implements PrimaryData
{
    public function __construct(ResourceObject $resource, ResourceObject ...$resources)
    {
        parent::__construct('data', func_get_args());
    }
}
