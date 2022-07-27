<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\PrimaryData;
use JsonSerializable;

/**
 * A Document containing the "data" member
 * @see http://jsonapi.org/format/#document-top-level
 */
final class DataDocument implements JsonSerializable {
    private object $value;

    public function __construct(PrimaryData $data, DataDocumentMember ...$members) {
        $this->value = combine($data, ...$members);
    }

    public function jsonSerialize(): object {
        return $this->value;
    }
}
