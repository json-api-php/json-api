<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceField;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

final class Attribute extends ResourceField
{
    private $val;

    public function __construct(string $name, $val)
    {
        parent::__construct($name);
        $this->val = $val;
    }

    public function attachTo(object $o)
    {
        child($o, 'attributes')->{$this->name} = $this->val;
    }

    public function registerIdentifier(IdentifierRegistry $registry)
    {
    }
}
