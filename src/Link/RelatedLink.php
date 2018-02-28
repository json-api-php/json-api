<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\RelationshipMember;

final class RelatedLink extends Link implements RelationshipMember
{
    protected $name = 'related';
}
