<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use function JsonApiPhp\JsonApi\combine;

class Error extends JsonSerializableValue
{
    public function __construct(ErrorMember ...$errorMembers)
    {
        parent::__construct(combine(...$errorMembers));
    }
}