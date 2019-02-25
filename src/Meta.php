<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorMember;
use JsonApiPhp\JsonApi\Internal\MetaDocumentMember;
use JsonApiPhp\JsonApi\Internal\RelationshipMember;
use JsonApiPhp\JsonApi\Internal\ResourceMember;

final class Meta implements ErrorMember, ErrorDocumentMember, MetaDocumentMember, DataDocumentMember, ResourceMember, RelationshipMember
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

    public function attachTo($o): void
    {
        child($o, 'meta')->{$this->key} = $this->value;
    }
}
