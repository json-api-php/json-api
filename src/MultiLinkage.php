<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceIdentifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;

class MultiLinkage extends AttachableValue implements RelationshipMember, Identifier
{
    /**
     * @var \JsonApiPhp\JsonApi\PrimaryData\ResourceIdentifier[]
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
