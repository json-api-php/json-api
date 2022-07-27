<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;
use JsonApiPhp\JsonApi\Internal\MetaDocumentMember;

final class JsonApi implements MetaDocumentMember, DataDocumentMember, ErrorDocumentMember {
    private readonly object $obj;

    public function __construct(string $version = '1.0', Meta $meta = null) {
        $this->obj = (object)[
            'version' => $version,
        ];
        $meta?->attachTo($this->obj);
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $o->jsonapi = $this->obj;
    }
}
