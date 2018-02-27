<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

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

    public function attachTo(object $o)
    {
        $o->id = $this->id;
    }
}
