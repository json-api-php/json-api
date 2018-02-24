<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\AttachableValue;

final class Code extends AttachableValue implements ErrorMember
{
    /**
     * @param string $code an application-specific error code, expressed as age string value
     */
    public function __construct(string $code)
    {
        parent::__construct('code', $code);
    }
}
