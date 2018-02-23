<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Error\ErrorMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;

final class Meta
    extends AttachableValue
    implements ErrorMember, TopLevelDocumentMember, DataDocumentMember, ResourceMember, RelationshipMember
{
    /**
     * @param array|object $meta
     */
    public function __construct($meta)
    {
        parent::__construct('meta', (object) $meta);
    }
}
