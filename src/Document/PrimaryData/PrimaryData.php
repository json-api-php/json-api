<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\PrimaryData;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Document\Member;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

abstract class PrimaryData extends JsonSerializableValue implements Member
{
    public function __construct()
    {
        parent::__construct($this);
    }

    abstract public function hasLinkTo(ResourceObject $resource): bool;

    final public function toName(): string
    {
        return 'data';
    }

}