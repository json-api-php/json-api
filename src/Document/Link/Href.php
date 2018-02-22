<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\DocumentMember;

class Href extends DocumentMember implements LinkObjectDocumentMember
{
    public function __construct(string $url)
    {
        parent::__construct($url);
    }

    /**
     * @return string Key to use for merging
     */
    final public function name(): string
    {
        return 'href';
    }
}