<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;

/**
 * A Document containing an array of Error objects
 * @see http://jsonapi.org/format/#document-top-level
 */
final class ErrorDocument implements \JsonSerializable
{
    private $obj;

    public function __construct(Error $error, ErrorDocumentMember ...$members)
    {
        $this->obj = (object) [];
        $error->attachTo($this->obj);
        foreach ($members as $member) {
            $member->attachTo($this->obj);
        }
    }

    public function jsonSerialize()
    {
        return $this->obj;
    }
}
