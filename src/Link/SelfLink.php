<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\DataDocumentMember;

final class SelfLink extends AttachableLink implements DataDocumentMember
{
    public function __construct(Link $link)
    {
        parent::__construct('self', $link);
    }
}
