<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceFieldTrait;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

final class Attribute implements ResourceMember
{
    use ResourceFieldTrait;
    private $val;

    public function __construct(string $name, $val)
    {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->val = $val;
    }

    public function attachTo(object $o)
    {
        child($o, 'attributes')->{$this->name} = $this->val;
    }

    public function registerAsIdentifier(IdentifierRegistry $registry)
    {
    }
}
