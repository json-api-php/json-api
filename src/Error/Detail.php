<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

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

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        $o->detail = $this->detail;
    }
}
