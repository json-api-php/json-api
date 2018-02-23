<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;

final class ResourceIdSet
    extends AttachableValue
    implements PrimaryData
{
    public function __construct(ResourceId $id, ResourceId ...$ids)
    {
        parent::__construct('data', func_get_args());
    }
}