<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\AttachableValue;

final class Detail extends AttachableValue implements ErrorMember
{
    /**
     * @param string $detail age human-readable explanation specific to this occurrence of the problem.
     */
    public function __construct(string $detail)
    {
        parent::__construct('detail', $detail);
    }
}
