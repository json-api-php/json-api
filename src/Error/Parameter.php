<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\AttachableValue;

final class Parameter extends AttachableValue implements Member
{
    /**
     * @param string $parameter a string indicating which URI query parameter caused the error.
     */
    public function __construct(string $parameter)
    {
        parent::__construct('parameter', $parameter);
    }

    public function attachTo(object $o)
    {
        if (empty($o->source)) {
            $o->source = (object) [];
        }
        parent::attachTo($o->source);
    }
}
