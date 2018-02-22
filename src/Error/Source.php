<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Error\Source\SourceMember;
use function JsonApiPhp\JsonApi\indexedByName;

class Source extends JsonSerializableValue
    implements ErrorMember
{
    public function __construct(SourceMember ...$sourceMembers)
    {
        parent::__construct(indexedByName(...$sourceMembers));
    }

    final public function name(): string
    {
        return 'source';
    }
}