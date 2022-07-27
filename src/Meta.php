<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use DomainException;
use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorMember;
use JsonApiPhp\JsonApi\Internal\MetaDocumentMember;
use JsonApiPhp\JsonApi\Internal\RelationshipMember;
use JsonApiPhp\JsonApi\Internal\ResourceMember;

final class Meta implements
    ErrorMember,
    ErrorDocumentMember,
    MetaDocumentMember,
    DataDocumentMember,
    ResourceMember,
    RelationshipMember {
        public function __construct(
            private readonly string $key,
            private readonly string|int|float|bool|null|array|object $value
        ) {
            if (!isValidName($key)) {
                throw new DomainException("Invalid character in a member name '$key'");
            }
        }

        /**
         * @param object $o
         * @internal
         */
        public function attachTo(object $o): void {
            child($o, 'meta')->{$this->key} = $this->value;
        }
    }
