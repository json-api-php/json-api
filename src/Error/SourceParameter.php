<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use function JsonApiPhp\JsonApi\child;
use JsonApiPhp\JsonApi\Internal\ErrorMember;

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

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        child($o, 'source')->parameter = $this->parameter;
    }
}
