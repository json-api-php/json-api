<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;
use function JsonApiPhp\JsonApi\combine;

final class ResourceObject extends AttachableValue implements PrimaryData
{
    private $type;
    private $id;

    public function __construct(string $type, string $id, ResourceMember ...$members)
    {
        $this->checkUniqueness(...$members);
        $obj = combine(...$members);
        $obj->type = $this->type = $type;
        $obj->id = $this->id = $id;
        parent::__construct('data', $obj);
    }

    public function toResourceId(): ResourceId
    {
        return new ResourceId($this->type, $this->id);
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
