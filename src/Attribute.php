<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;

/**
 * @see http://jsonapi.org/format/#document-resource-object-attributes
 */
final class Attribute implements ResourceField {
    use ResourceFieldTrait;

    private string|int|float|bool|null|array|object $val;

    public function __construct(string $name, $val) {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->val = $val;
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        child($o, 'attributes')->{$this->name} = $this->val;
    }
}
