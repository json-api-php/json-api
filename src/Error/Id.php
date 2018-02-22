<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;

class Id
    extends JsonSerializableValue
    implements ErrorMember
{
    /**
     * @param string $id a unique identifier for this particular occurrence of the problem
     */
    public function __construct(string $id)
    {
        parent::__construct($id);
    }

    final public function name(): string
    {
        return 'id';
    }
}