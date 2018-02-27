<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

final class ErrorDocument implements \JsonSerializable
{
    private $doc;

    public function __construct(Error $error, ErrorDocumentMember ...$members)
    {
        $this->doc = combine($error, ...$members);
    }

    public function jsonSerialize()
    {
        return $this->doc;
    }
}
