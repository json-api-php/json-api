<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\ToManyMember;
use JsonApiPhp\JsonApi\ToOneMember;

final class RelatedLink extends Link implements ToOneMember, ToManyMember
{
    protected $name = 'related';
}
