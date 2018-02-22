<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\AttachableValue;
use JsonApiPhp\JsonApi\Error\Source\SourceMember;
use function JsonApiPhp\JsonApi\combine;

final class Source
    extends AttachableValue
    implements ErrorMember
{
    public function __construct(SourceMember ...$sourceMembers)
    {
        parent::__construct('source', combine(...$sourceMembers));
    }
}