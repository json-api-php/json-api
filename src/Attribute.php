<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceField;

final class Attribute extends ResourceField
{
    public function attachTo(object $o)
    {
        parent::attachTo(child($o, 'attributes'));
    }
}
