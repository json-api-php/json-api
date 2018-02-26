<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\AttachableValue;
use function JsonApiPhp\JsonApi\child;

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
        parent::attachTo(child($o, 'source'));
    }
}
