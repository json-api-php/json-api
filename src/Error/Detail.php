<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

final class Detail implements ErrorMember
{
    /**
     * @var string
     */
    private $detail;

    /**
     * @param string $detail a human-readable explanation specific to this occurrence of the problem.
     */
    public function __construct(string $detail)
    {
        $this->detail = $detail;
    }

    public function attachTo(object $o)
    {
        $o->detail = $this->detail;
    }
}
