<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class DataDocument implements \JsonSerializable
{
    private $value;

    public function __construct(PrimaryData $data, DataDocumentMember ...$members)
    {
        $this->value = combine($data, ...$members);
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}
