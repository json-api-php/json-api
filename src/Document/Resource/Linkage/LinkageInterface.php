<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource\Linkage;

use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

interface LinkageInterface extends \JsonSerializable
{
    public function isLinkedTo(ResourceObject $resource): bool;

    public function jsonSerialize();
}
