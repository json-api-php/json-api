<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

class Attribute extends ResourceField
{
    public function attachTo(object $o)
    {
        if (empty($o->attributes)) {
            $o->attributes = (object) [];
        }
        parent::attachTo($o->attributes);
    }
}
