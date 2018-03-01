<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Error\ErrorMember;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\ResourceObject\FieldRegistry;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

final class Meta implements ErrorMember, MetaDocumentMember, DataDocumentMember, ResourceMember, ToOneMember
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

    public function registerResourceField(FieldRegistry $registry)
    {
    }

    public function registerIdentifier(IdentifierRegistry $registry)
    {
    }
}
