<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Error\ErrorMember;

final class Meta
    extends AttachableValue
    implements ErrorMember, TopLevelDocumentMember, DataDocumentMember
{
    /**
     * @param array|object $meta
     */
    public function __construct($meta)
    {
        parent::__construct('meta', (object) $meta);
    }
}