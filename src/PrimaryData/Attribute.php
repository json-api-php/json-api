<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use function JsonApiPhp\JsonApi\child;

class Attribute extends ResourceField
{
    public function attachTo(object $o)
    {
        parent::attachTo(child($o, 'attributes'));
    }
}
