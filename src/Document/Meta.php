<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\Document\Error\ErrorMember;
use JsonApiPhp\JsonApi\Document\JsonApi\JsonApiMember;
use JsonApiPhp\JsonApi\Document\Link\LinkObjectMember;

class Meta
    extends JsonSerializableValue
    implements ErrorMember, LinkObjectMember, DocumentMember, JsonApiMember
{
    /**
     * @param mixed $meta Meta object
     */
    public function __construct($meta)
    {
        parent::__construct((object) $meta);
    }

    /**
     * @return string Key to use for merging
     */
    final public function toName(): string
    {
        return 'meta';
    }
}