<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\Document\Link\LinkSet;

class Links extends LinkSet implements DataDocumentMember
{
    public function __construct(LinksMember ...$linksMembers)
    {
        parent::__construct(...$linksMembers);
    }
}