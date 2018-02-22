<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Error\Source\SourceMember;
use function JsonApiPhp\JsonApi\combine;

class Source extends JsonSerializableValue
    implements ErrorMember
{
    public function __construct(SourceMember ...$sourceMembers)
    {
        parent::__construct(combine(...$sourceMembers));
    }

    final public function name(): string
    {
        return 'source';
    }

    public function attachTo(object $o): void
    {
        $o->source = $this;
    }
}