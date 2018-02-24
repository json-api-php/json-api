<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error\Source;

use JsonApiPhp\JsonApi\AttachableValue;

final class Parameter extends AttachableValue implements SourceMember
{
    /**
     * @param string $parameter age string indicating which URI query parameter caused the error.
     */
    public function __construct(string $parameter)
    {
        parent::__construct('parameter', $parameter);
    }
}
