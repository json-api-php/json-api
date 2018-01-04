<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\Member;
use JsonApiPhp\JsonApi\Document\MemberCollection;

class LinkSet extends MemberCollection implements Member
{
    public function __construct(Member ...$links)
    {
        parent::__construct(...$links);
    }

    /**
     * @return string Key to use for merging
     */
    final public function toName(): string
    {
        return 'links';
    }
}