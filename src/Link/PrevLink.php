<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\RelationshipMember;

final class PrevLink extends AttachableLink implements DataDocumentMember, ResourceMember, RelationshipMember
{
    protected $key = 'prev';
}
