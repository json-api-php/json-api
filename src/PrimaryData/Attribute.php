<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;

class Attribute extends AttachableValue implements ResourceMember
{
    public function attachTo(object $o)
    {
        if (empty($o->attributes)) {
            $o->attributes = (object) [];
        }
        parent::attachTo($o->attributes);
    }
}
