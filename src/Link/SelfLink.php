<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\RelationshipMember;

final class SelfLink extends Link implements DataDocumentMember, ResourceMember, RelationshipMember
{
    protected $name = 'self';
}
