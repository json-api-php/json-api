<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Error\ErrorMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;

final class Meta implements Attachable, ErrorMember, TopLevelDocumentMember, DataDocumentMember, ResourceMember, RelationshipMember
{
    /**
     * @var string
     */
    private $key;
    private $value;

    public function __construct(string $key, $value)
    {
        if (isValidName($key) === false) {
            throw new \DomainException("Invalid character in a member name '$key'");
        }
        $this->key = $key;
        $this->value = $value;
    }

    public function attachTo(object $o)
    {
        child($o, 'meta')->{$this->key} = $this->value;
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}
