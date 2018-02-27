<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

final class MetaDocument implements \JsonSerializable
{
    private $doc;

    public function __construct(Meta $meta, TopLevelDocumentMember ...$members)
    {
        $this->doc = combine($meta, ...$members);
    }

    public function jsonSerialize()
    {
        return $this->doc;
    }
}
