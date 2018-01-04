<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Error;

use JsonApiPhp\JsonApi\Document\Error\Source\SourceMember;
use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Document\Member;
use JsonApiPhp\JsonApi\Document\MemberCollection;
use function JsonApiPhp\JsonApi\mergeAll;

class Source
    extends MemberCollection
    implements ErrorMember
{
    public function __construct(SourceMember ...$sourceMembers)
    {
        parent::__construct(...$sourceMembers);
    }

    final public function toName(): string
    {
        return 'source';
    }
}