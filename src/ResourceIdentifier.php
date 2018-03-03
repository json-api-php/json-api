<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\IdentifierRegistry;
use JsonApiPhp\JsonApi\Internal\IdentityTrait;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class ResourceIdentifier implements PrimaryData
{
    use IdentityTrait;
    private $obj;

    public function __construct(string $type, string $id, Meta $meta = null)
    {
        if (isValidName($type) === false) {
            throw new \DomainException("Invalid type value: $type");
        }

        $this->obj = (object) [
            'type' => $type,
            'id' => $id,
        ];
        if ($meta) {
            $meta->attachTo($this->obj);
        }
        $this->type = $type;
        $this->id = $id;
    }

    public function attachTo(object $o): void
    {
        $o->data = $this->obj;
    }

    public function attachToCollection(object $o): void
    {
        $o->data[] = $this->obj;
    }

    public function registerIn(IdentifierRegistry $registry)
    {
        $registry->add($this->key());
    }
}
