<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorMember;
use JsonApiPhp\JsonApi\Internal\FieldRegistry;
use JsonApiPhp\JsonApi\Internal\IdentifierRegistry;
use JsonApiPhp\JsonApi\Internal\MetaDocumentMember;
use JsonApiPhp\JsonApi\Internal\ResourceMember;
use JsonApiPhp\JsonApi\Internal\ToManyMember;
use JsonApiPhp\JsonApi\Internal\ToOneMember;

final class Meta implements ErrorMember, ErrorDocumentMember, MetaDocumentMember, DataDocumentMember, ResourceMember, ToOneMember, ToManyMember
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

    public function registerField(FieldRegistry $registry)
    {
    }
}
