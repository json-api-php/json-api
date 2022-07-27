<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\PrimaryData;
use JsonSerializable;

/**
 * A Document with the "included" member
 * @see http://jsonapi.org/format/#document-compound-documents
 */
final class CompoundDocument implements JsonSerializable {
    private object $doc;

    public function __construct(PrimaryData $data, Included $included, DataDocumentMember ...$members) {
        $this->doc = combine($data, $included, ...$members);
    }

    public function jsonSerialize(): object {
        return $this->doc;
    }
}
