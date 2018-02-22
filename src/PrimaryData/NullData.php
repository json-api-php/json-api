<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

class NullData extends PrimaryData
{
    public function __construct()
    {
        parent::__construct(null);
    }

    public function hasLinkTo(ResourceObject $resource): bool
    {
        return false;
    }
}