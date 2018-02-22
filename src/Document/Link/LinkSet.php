<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\DocumentMember;
use function JsonApiPhp\JsonApi\indexedByName;

class LinkSet
    extends JsonSerializableValue
    implements DocumentMember
{
    public function __construct(DocumentMember ...$links)
    {
        parent::__construct(indexedByName(...$links));
    }

    /**
     * @return string Key to use for merging
     */
    final public function name(): string
    {
        return 'links';
    }
}