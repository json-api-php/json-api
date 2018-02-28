<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceField;

final class ToNull extends ResourceField
{
    /**
     * @var ToOneMember[]
     */
    private $members;

    public function __construct(string $name, ToOneMember ...$members)
    {
        parent::__construct($name);
        $this->members = $members;
    }

    public function attachTo(object $o)
    {
        $val = combine(...$this->members);
        $val->data = null;
        child($o, 'relationships')->{$this->name()} = $val;
    }
}
