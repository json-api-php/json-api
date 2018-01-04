<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Document\Member;

class AboutLink extends JsonSerializableValue implements Member
{
    public function __construct(Link $link)
    {
        parent::__construct($link);
    }

    /**
     * @return string Key to use for merging
     */
    final public function toName(): string
    {
        return 'about';
    }
}