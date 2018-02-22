<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;

class Code
    extends JsonSerializableValue
    implements ErrorMember
{
    /**
     * @param string $code an application-specific error code, expressed as a string value
     */
    public function __construct(string $code)
    {
        parent::__construct($code);
    }

    public function attachTo(object $o): void
    {
        $o->code = $this;
    }
}