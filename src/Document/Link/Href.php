<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\Member;

class Href extends Member implements LinkObjectMember
{
    public function __construct(string $url)
    {
        parent::__construct($url);
    }

    /**
     * @return string Key to use for merging
     */
    final protected function toName(): string
    {
        return 'href';
    }
}