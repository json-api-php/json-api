<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error\Source;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;

final class Parameter
    extends JsonSerializableValue
    implements SourceMember
{
    /**
     * @param string $parameter a string indicating which URI query parameter caused the error.
     */
    public function __construct(string $parameter)
    {
        parent::__construct($parameter);
    }

    public function name(): string
    {
        return 'parameter';
    }
}