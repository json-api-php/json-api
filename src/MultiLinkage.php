<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;

class MultiLinkage extends AttachableValue implements RelationshipMember, Identifier
{
    /**
     * @var \JsonApiPhp\JsonApi\ResourceIdentifier[]
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
