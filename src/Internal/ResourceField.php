<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

interface ResourceField extends ResourceMember
{
    public function name(): string;
}
