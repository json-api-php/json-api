<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

final class Id implements ErrorMember
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id a unique identifier for this particular occurrence of the problem
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        $o->id = $this->id;
    }
}
