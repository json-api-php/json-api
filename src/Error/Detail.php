<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\AttachableValue;

class Detail
    extends AttachableValue
    implements ErrorMember
{
    /**
     * @param string $detail a human-readable explanation specific to this occurrence of the problem.
     */
    public function __construct(string $detail)
    {
        parent::__construct('detail', $detail);
    }
}