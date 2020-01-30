<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class ResourceIdentifier implements PrimaryData
{
    private $obj;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $id;

    public function __construct(string $type, string $id, Meta ...$metas)
    {
        if (isValidName($type) === false) {
            throw new \DomainException("Invalid type value: $type");
        }

        $this->obj = (object) [
            'type' => $type,
            'id' => $id,
        ];
        foreach ($metas as $meta) {
            $meta->attachTo($this->obj);
        }
        $this->type = $type;
        $this->id = $id;
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo($o): void
    {
        $o->data = $this->obj;
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachToCollection($o): void
    {
        $o->data[] = $this->obj;
    }

    public function registerIn(array &$registry): void
    {
        $registry[compositeKey($this->type, $this->id)] = true;
    }
}
