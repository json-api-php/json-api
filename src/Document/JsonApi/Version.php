<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\JsonApi;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;

class Version extends JsonSerializableValue implements JsonApiDocumentMember
{
    public function __construct(string $version)
    {
        parent::__construct($version);
    }

    final public function name(): string
    {
        return 'version';
    }
}