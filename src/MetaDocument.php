<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\MetaDocumentMember;
use JsonSerializable;

final class MetaDocument implements JsonSerializable {
    private readonly object $doc;

    public function __construct(Meta $meta, MetaDocumentMember ...$members) {
        $this->doc = combine($meta, ...$members);
    }

    public function jsonSerialize(): object {
        return $this->doc;
    }
}
