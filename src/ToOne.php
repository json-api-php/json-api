<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Identifier;
use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;
use JsonApiPhp\JsonApi\Internal\ToOneMember;

final class ToOne implements Identifier, ResourceField {
    use ResourceFieldTrait;

    private readonly object $obj;

    public function __construct(string $name, private readonly ResourceIdentifier $identifier, ToOneMember ...$members) {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->obj = combine($identifier, ...$members);
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo($o): void {
        child($o, 'relationships')->{$this->name} = $this->obj;
    }
}
