<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\Document\Error\ErrorMember;
use function JsonApiPhp\JsonApi\mergeAll;

class Error extends MemberCollection
{
    public function __construct(ErrorMember ...$errorMembers)
    {
        parent::__construct(...$errorMembers);
    }
}