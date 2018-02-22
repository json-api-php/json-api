<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class DataDocument extends JsonSerializableValue
{
    public function __construct(PrimaryData $data, DataDocumentMember ...$documentMembers)
    {
        parent::__construct(combine($data, ...$documentMembers));
    }
}