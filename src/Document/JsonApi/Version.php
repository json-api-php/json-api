<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\JsonApi;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;

class Version extends JsonSerializableValue implements JsonApiMember
{
    public function __construct(string $version)
    {
        parent::__construct($version);
    }

    final public function toName(): string
    {
        return 'version';
    }
}