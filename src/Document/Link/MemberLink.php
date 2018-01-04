<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Document\Member;

abstract class MemberLink extends JsonSerializableValue implements Member
{
    public function __construct(Link $link)
    {
        parent::__construct($link);
    }
}