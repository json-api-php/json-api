<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\LinksMember;

class RelatedLink extends MemberLink implements LinksMember
{
    /**
     * @return string Key to use for merging
     */
    final protected function toName(): string
    {
        return 'related';
    }
}