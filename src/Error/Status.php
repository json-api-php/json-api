<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;

class Status
    extends JsonSerializableValue
    implements ErrorMember
{
    /**
     * @param string $status the HTTP status code applicable to this problem, expressed as a string value
     */
    public function __construct(string $status)
    {
        parent::__construct($status);
    }

    final public function name(): string
    {
        return 'status';
    }
}