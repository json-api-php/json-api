<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\AttachableValue;
use JsonApiPhp\JsonApi\Error\Source\SourceMember;
use function JsonApiPhp\JsonApi\combine;

class Source
    extends AttachableValue
    implements ErrorMember
{
    public function __construct(SourceMember ...$sourceMembers)
    {
        parent::__construct('source', combine(...$sourceMembers));
    }
}