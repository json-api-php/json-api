<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\ResourceObject\FieldRegistry;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;
use JsonApiPhp\JsonApi\ToManyMember;
use JsonApiPhp\JsonApi\ToOneMember;

final class SelfLink extends Link implements DataDocumentMember, ResourceMember, ToOneMember, ToManyMember
{
    protected $name = 'self';

    public function registerResourceField(FieldRegistry $registry)
    {
    }

    public function registerIdentifier(IdentifierRegistry $registry)
    {
    }
}
