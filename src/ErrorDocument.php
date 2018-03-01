<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;

final class ErrorDocument implements \JsonSerializable
{
    private $doc;

    public function __construct(Error $error, ErrorDocumentMember ...$members)
    {
        $this->doc = (object) [];
        $error->attachTo($this->doc);
        foreach ($members as $member) {
            $member->attachTo($this->doc);
        }
    }

    public function jsonSerialize()
    {
        return $this->doc;
    }
}
