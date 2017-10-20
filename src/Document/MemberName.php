<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

class MemberName extends SpecialValue
{
    public function __construct(string $type)
    {
        parent::__construct($type, "Invalid member name '%'");
    }
}
