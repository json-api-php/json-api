<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

final class Status implements ErrorMember
{
    /**
     * @var string
     */
    private $status;

    /**
     * @param string $status the HTTP status code applicable to this problem, expressed as a string value
     */
    public function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo($o): void
    {
        $o->status = $this->status;
    }
}
