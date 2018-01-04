<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Document\DocumentMember;
use JsonApiPhp\JsonApi\Document\MemberCollection;
use JsonApiPhp\JsonApi\Document\Meta;

class MetaDocument extends MemberCollection
{
    public function __construct(Meta $meta, DocumentMember ...$members)
    {
        parent::__construct($meta, ...$members);
    }
}