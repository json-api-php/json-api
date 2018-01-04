<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use function JsonApiPhp\JsonApi\mergeAll;

class LinkObject extends JsonSerializableValue implements Link
{
    public function __construct(LinkObjectMember ...$linkObjectMembers)
    {
        parent::__construct((object) mergeAll([], ...$linkObjectMembers));
    }
}