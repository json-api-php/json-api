<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\MetaDocumentMember;

final class MetaDocument implements \JsonSerializable
{
    private $doc;

    public function __construct(Meta $meta, MetaDocumentMember ...$members)
    {
        $this->doc = combine($meta, ...$members);
    }

    public function jsonSerialize()
    {
        return $this->doc;
    }
}
