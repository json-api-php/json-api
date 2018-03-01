<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

final class NullData implements PrimaryData, ToOneMember
{
    public function attachTo(object $o)
    {
        $o->data = null;
    }

    public function registerIn(IdentifierRegistry $registry)
    {
    }
}
