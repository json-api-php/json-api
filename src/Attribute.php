<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;

/**
 * @see http://jsonapi.org/format/#document-resource-object-attributes
 */
final class Attribute implements ResourceField
{
    use ResourceFieldTrait;
    private $val;

    public function __construct(string $name, $val)
    {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->val = $val;
    }

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        child($o, 'attributes')->{$this->name} = $this->val;
    }
}
