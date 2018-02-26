<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

final class MetaDocument extends JsonSerializableValue
{
    public function __construct(Meta $meta, TopLevelDocumentMember ...$members)
    {
        parent::__construct(combine($meta, ...$members));
    }
}
