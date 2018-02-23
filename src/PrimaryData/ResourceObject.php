<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;
use function JsonApiPhp\JsonApi\combine;

class ResourceObject extends AttachableValue implements PrimaryData
{
    public function __construct(string $type, string $id, ResourceMember ...$members)
    {
        $obj = combine(...$members);
        $obj->type = $type;
        $obj->id = $id;
        parent::__construct('data', $obj);
    }
}
