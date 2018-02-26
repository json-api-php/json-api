<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;
use function JsonApiPhp\JsonApi\combine;

final class ResourceObject extends AttachableValue implements PrimaryData
{
    private $type;
    private $id;

    /**
     * @var Identifier[]
     */
    private $identifiers = [];

    public function __construct(string $type, string $id = null, ResourceMember ...$members)
    {
        $this->checkUniqueness(...$members);
        $obj = combine(...$members);
        $obj->type = $this->type = $type;
        $obj->id = $this->id = $id;
        parent::__construct('data', $obj);
        foreach ($members as $member) {
            if ($member instanceof Identifier) {
                $this->identifiers[] = $member;
            }
        }
    }

    public function toResourceId(): ResourceIdentifier
    {
        return new ResourceIdentifier($this->type, $this->id);
    }

    public function identifies(ResourceObject $resource): bool
    {
        foreach ($this->identifiers as $identifier) {
            if ($identifier->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    public function __toString(): string
    {
        return "$this->type:$this->id";
    }

    private function checkUniqueness(ResourceMember ...$members): void
    {
        $keys = [];
        foreach ($members as $member) {
            if ($member instanceof ResourceField) {
                $key = $member->toKey();
                if (isset($keys[$key])) {
                    throw new \DomainException("Field '$key' already exists'");
                }
                $keys[$key] = true;
            }
        }
    }
}
