<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Linkage;

use JsonApiPhp\JsonApi\AttachableValue;
use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceId;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;
use JsonApiPhp\JsonApi\RelationshipMember;

class MultiLinkage extends AttachableValue implements RelationshipMember, Identifier
{
    /**
     * @var \JsonApiPhp\JsonApi\PrimaryData\ResourceId[]
     */
    private $identifiers = [];

    public function __construct(ResourceId ...$identifiers)
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
