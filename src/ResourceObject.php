<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;
use JsonApiPhp\JsonApi\PrimaryData\ResourceField;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;

final class ResourceObject implements PrimaryData
{
    private $type;
    private $id;

    private $members = [];

    public function __construct(string $type, string $id = null, ResourceMember ...$members)
    {
        $keys = [];
        foreach ($members as $member) {
            if ($member instanceof ResourceField) {
                $key = $member->name();
                if (isset($keys[$key])) {
                    throw new \LogicException("Field '$key' already exists'");
                }
                $keys[$key] = true;
            }
        }

        $this->members = $members;
        $this->type = $type;
        $this->id = $id;
    }

    public function identifier(): ResourceIdentifier
    {
        return new ResourceIdentifier($this->type, $this->id);
    }

    public function identifies(ResourceObject $resource): bool
    {
        foreach ($this->members as $member) {
            if ($member instanceof Identifier && $member->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    public function attachTo(object $o)
    {
        $o->data = $this->buildObject();
    }

    public function attachAsIncludedTo(object $o): void
    {
        $o->included[] = $this->buildObject();
    }

    public function attachToCollection(object $o): void
    {
        $o->data[] = $this->buildObject();
    }

    public function uniqueId(): string
    {
        return "{$this->type}:{$this->id}";
    }

    private function buildObject(): object
    {
        $obj = combine(...$this->members);
        $obj->type = $this->type;
        $obj->id = $this->id;
        return $obj;
    }
}
