<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\DocumentMember;

abstract class DocumentMemberLink extends JsonSerializableValue implements DocumentMember
{
    public function __construct(Link $link)
    {
        parent::__construct($link);
    }
}