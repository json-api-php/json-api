<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;

final class ResourceIdentifierSet extends AttachableValue implements PrimaryData
{
    /**
     * @var ResourceIdentifier[]
     */
    private $identifiers = [];

    public function __construct(ResourceIdentifier $identifier, ResourceIdentifier ...$ids)
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