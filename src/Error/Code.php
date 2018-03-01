<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

final class Code implements ErrorMember
{
    /**
     * @var string
     */
    private $code;

    /**
     * @param string $code an application-specific error code, expressed as a string value
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function attachTo(object $o): void
    {
        $o->code = $this->code;
    }
}
