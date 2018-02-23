<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;

final class SelfLink extends AttachableLink implements DataDocumentMember, ResourceMember
{
    public function __construct(Link $link)
    {
        parent::__construct('self', $link);
    }
}
