<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use function JsonApiPhp\JsonApi\child;

final class SourceParameter implements ErrorMember
{
    /**
     * @var string
     */
    private $parameter;

    /**
     * @param string $parameter a string indicating which URI query parameter caused the error.
     */
    public function __construct(string $parameter)
    {
        $this->parameter = $parameter;
    }

    public function attachTo(object $o): void
    {
        child($o, 'source')->parameter = $this->parameter;
    }
}
