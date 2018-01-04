<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Error;

use JsonApiPhp\JsonApi\Document\Error\Source\SourceMember;
use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Document\Member;
use function JsonApiPhp\JsonApi\mergeAll;

class Detail
    extends JsonSerializableValue
    implements ErrorMember
{
    /**
     * @param string $detail a human-readable explanation specific to this occurrence of the problem.
     */
    public function __construct(string $detail)
    {
        parent::__construct($detail);
    }

    final public function toName(): string
    {
        return 'detail';
    }
}