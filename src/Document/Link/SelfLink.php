<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\LinksMember;

class SelfLink extends DocumentMemberLink implements LinksMember
{
    /**
     * @return string Key to use for merging
     */
    final public function name(): string
    {
        return 'self';
    }
}