<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;
use JsonApiPhp\JsonApi\PrimaryData\ResourceField;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;

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
        $keys = [];
        foreach ($members as $member) {
            if ($member instanceof Identifier) {
                $this->identifiers[] = $member;
            }
            if ($member instanceof ResourceField) {
                $key = $member->key();
                if (isset($keys[$key])) {
                    throw new \LogicException("Field '$key' already exists'");
                }
                $keys[$key] = true;
            }
        }

        $obj = combine(...$members);
        $obj->type = $type;
        $obj->id = $id;
        parent::__construct('data', $obj);
        $this->type = $type;
        $this->id = $id;
    }

    public function identifier(): ResourceIdentifier
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
}
