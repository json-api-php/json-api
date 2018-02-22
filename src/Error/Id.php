<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\AttachableValue;

final class Id extends AttachableValue implements ErrorMember
{
    /**
     * @param string $id a unique identifier for this particular occurrence of the problem
     */
    public function __construct(string $id)
    {
        parent::__construct('id', $id);
    }
}
