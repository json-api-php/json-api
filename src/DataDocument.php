<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Document\DataDocumentMember;
use JsonApiPhp\JsonApi\Document\MemberCollection;
use JsonApiPhp\JsonApi\Document\PrimaryData\PrimaryData;

class DataDocument extends MemberCollection
{
    public function __construct(PrimaryData $data, DataDocumentMember ...$documentMembers)
    {
        parent::__construct($data, ...$documentMembers);
    }
}