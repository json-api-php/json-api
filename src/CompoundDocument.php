<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class CompoundDocument implements \JsonSerializable
{
    private $doc;

    public function __construct(PrimaryData $data, Included $included, DataDocumentMember ...$members)
    {
        $included->validateLinkage($data);
        $this->doc = combine($data, $included, ...$members);
    }

    public function jsonSerialize()
    {
        return $this->doc;
    }
}
