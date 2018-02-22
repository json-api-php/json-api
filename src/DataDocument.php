<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

class DataDocument extends JsonSerializableValue
{
    public function __construct(PrimaryData $data, DataDocumentMember ...$documentMembers)
    {
        parent::__construct(indexedByName($data, ...$documentMembers));
    }
}