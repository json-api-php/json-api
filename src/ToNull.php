<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;
use JsonApiPhp\JsonApi\Internal\ToOneMember;

final class ToNull implements ResourceField {
    use ResourceFieldTrait;

    /**
     * @var ToOneMember[]
     */
    private readonly array $members;

    public function __construct(string $name, ToOneMember ...$members) {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->members = $members;
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $obj = combine(...$this->members);
        $obj->data = null;
        child($o, 'relationships')->{$this->name} = $obj;
    }
}
