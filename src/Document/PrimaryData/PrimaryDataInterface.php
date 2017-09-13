<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\PrimaryData;

use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

interface PrimaryDataInterface extends \JsonSerializable
{
    public function hasLinkTo(ResourceObject $resource): bool;
}
