<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;
use JsonSerializable;

/**
 * A Document containing an array of Error objects
 * @see http://jsonapi.org/format/#document-top-level
 */
final class ErrorDocument implements JsonSerializable {
    private readonly object $obj;

    public function __construct(ErrorDocumentMember ...$members) {
        $this->obj = (object)[];
        foreach ($members as $member) {
            $member->attachTo($this->obj);
        }
    }

    public function jsonSerialize(): object {
        return $this->obj;
    }
}
