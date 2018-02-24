<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceField;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;

final class Relationship extends ResourceField implements Identifier
{
    /**
     * @var \JsonApiPhp\JsonApi\PrimaryData\Identifier[]
     */
    private $identifiers = [];

    public function __construct(string $key, RelationshipMember $member, RelationshipMember ...$members)
    {
        parent::__construct($key, combine($member, ...$members));
        foreach ([$member] + $members as $m) {
            if ($m instanceof Identifier) {
                $this->identifiers[] = $m;
            }
        }
    }

    public function attachTo(object $o)
    {
        if (empty($o->relationships)) {
            $o->relationships = (object) [];
        }
        parent::attachTo($o->relationships);
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
