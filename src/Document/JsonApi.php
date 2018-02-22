<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\Document\JsonApi\Version;
use JsonApiPhp\JsonApi\TopLevelDocumentMember;
use function JsonApiPhp\JsonApi\indexedByName;

final class JsonApi
    extends JsonSerializableValue
    implements TopLevelDocumentMember, DataDocumentMember
{
    public function __construct(string $version, Meta $meta = null)
    {
        parent::__construct(indexedByName(new Version($version), ...($meta ? [$meta] : [])));
    }

    /**
     * @return string Key to use for merging
     */
    public function name(): string
    {
        return 'jsonapi';
    }
}