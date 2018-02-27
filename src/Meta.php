<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Error\ErrorMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;

final class Meta extends AttachableValue implements ErrorMember, TopLevelDocumentMember, DataDocumentMember, ResourceMember, RelationshipMember
{
    public function __construct(string $key, $value)
    {
        if (isValidName($key) === false) {
            throw new \DomainException("Invalid character in a member name '$key'");
        }

        parent::__construct($key, $value);
    }

    public function attachTo(object $o)
    {
        parent::attachTo(child($o, 'meta'));
    }
}
