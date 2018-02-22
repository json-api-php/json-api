<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\DocumentMember;

class AboutLink
    extends JsonSerializableValue
    implements DocumentMember
{
    public function __construct(Link $link)
    {
        parent::__construct($link);
    }

    /**
     * @return string Key to use for merging
     */
    final public function name(): string
    {
        return 'about';
    }
}