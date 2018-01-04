<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\Document\JsonApi\JsonApiMember;

class JsonApi extends MemberCollection implements DocumentMember
{
    public function __construct(JsonApiMember ...$members)
    {
        parent::__construct(...$members);
    }

    /**
     * @return string Key to use for merging
     */
    final public function toName(): string
    {
        return 'jsonapi';
    }
}