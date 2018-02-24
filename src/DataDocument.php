<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class DataDocument extends JsonSerializableValue
{
    /**
     * @var Identifier[]
     */
    private $identifiers = [];

    public function __construct(PrimaryData $data, DataDocumentMember ...$members)
    {
        parent::__construct(combine($data, ...$members));
    }
}
