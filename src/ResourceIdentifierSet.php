<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class ResourceIdentifierSet extends AttachableValue implements PrimaryData
{
    /**
     * @var ResourceIdentifier[]
     */
    private $identifiers = [];

    public function __construct(ResourceIdentifier ...$identifiers)
    {
        parent::__construct('data', $identifiers);
        $this->identifiers = $identifiers;
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
