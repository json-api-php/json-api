<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\ToOneMember;

final class PrevLink extends Link implements DataDocumentMember, ResourceMember, ToOneMember
{
    protected $name = 'prev';
}
