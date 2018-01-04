<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

class MemberCollection extends JsonSerializableValue
{
    public function __construct(Member ...$members)
    {
        $collection = [];
        foreach ($members as $m) {
            $collection[$m->toName()] = $m;
        }
        parent::__construct((object)$collection);
    }
}