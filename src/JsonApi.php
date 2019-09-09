<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;
use JsonApiPhp\JsonApi\Internal\MetaDocumentMember;

final class JsonApi implements MetaDocumentMember, DataDocumentMember, ErrorDocumentMember
{
    public $version;

    public function __construct(string $version = '1.0', Meta $meta = null)
    {
        $this->version = $version;
        if ($meta) {
            $meta->attachTo($this);
        }
    }

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        $o->jsonapi = $this;
    }
}
