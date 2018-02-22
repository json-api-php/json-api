<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Document\Meta;

class MetaDocument extends JsonSerializableValue
{
    public function __construct(Meta $meta, TopLevelDocumentMember ...$members)
    {
        parent::__construct(indexedByName($meta, ...$members));
    }
}