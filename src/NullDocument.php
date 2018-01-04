<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Document\DataDocumentMember;
use JsonApiPhp\JsonApi\Document\PrimaryData\NullData;

class NullDocument extends DataDocument
{
    public function __construct(DataDocumentMember ...$documentMembers)
    {
        parent::__construct(new NullData(), ...$documentMembers);
    }
}