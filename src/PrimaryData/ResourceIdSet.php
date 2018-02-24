<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;

final class ResourceIdSet extends AttachableValue implements PrimaryData
{
    /**
     * @var ResourceId[]
     */
    private $identifiers = [];

    public function __construct(ResourceId $identifier, ResourceId ...$ids)
    {
        $this->identifiers = func_get_args();
        parent::__construct('data', $this->identifiers);
    }

    public function identifies(ResourceObject $resource): bool
    {
        foreach ($this->identifiers as $identifier) {
            if ($identifier->identifies($resource)) {
                return true;
            }
        }
        return false;
    }
}
