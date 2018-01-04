<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Error;

use JsonApiPhp\JsonApi\Document\Error\Source\SourceMember;
use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Document\Member;
use function JsonApiPhp\JsonApi\mergeAll;

class Code
    extends JsonSerializableValue
    implements ErrorMember
{
    /**
     * @param string $code an application-specific error code, expressed as a string value
     */
    public function __construct(string $code)
    {
        parent::__construct($code);
    }

    final public function toName(): string
    {
        return 'code';
    }
}