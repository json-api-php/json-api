<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

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

    public function attachTo(object $o)
    {
        $o->status = $this->status;
    }
}
