<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use JsonApiPhp\JsonApi\DocumentMember;

abstract class PrimaryData
    extends JsonSerializableValue
    implements DocumentMember
{
    abstract public function hasLinkTo(ResourceObject $resource): bool;

    final public function name(): string
    {
        return 'data';
    }
}