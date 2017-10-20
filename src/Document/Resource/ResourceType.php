<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\SpecialValue;

class ResourceType extends SpecialValue
{
    public function __construct(string $type)
    {
        parent::__construct($type, "Invalid resource type '%'");
    }
}
