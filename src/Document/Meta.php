<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\Document\JsonApi\JsonApiDocumentMember;
use JsonApiPhp\JsonApi\Document\Link\LinkObjectDocumentMember;
use JsonApiPhp\JsonApi\DocumentMember;
use JsonApiPhp\JsonApi\Error\ErrorMember;
use JsonApiPhp\JsonApi\TopLevelDocumentMember;

final class Meta
    extends JsonSerializableValue
    implements ErrorMember, TopLevelDocumentMember, DataDocumentMember
{
    /**
     * @param array|object $meta
     */
    public function __construct($meta)
    {
        parent::__construct((object) $meta);
    }

    public function attachTo(object $o): void
    {
        $o->meta = $this;
    }
}