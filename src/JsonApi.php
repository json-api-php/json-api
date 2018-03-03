<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;
use JsonApiPhp\JsonApi\Internal\MetaDocumentMember;

final class JsonApi implements MetaDocumentMember, DataDocumentMember, ErrorDocumentMember
{
    private $jsonapi;

    public function __construct(string $version = '1.0', Meta $meta = null)
    {
        $this->jsonapi = (object) [
            'version' => $version,
        ];
        if ($meta) {
            $meta->attachTo($this->jsonapi);
        }
    }

    public function attachTo(object $o): void
    {
        $o->jsonapi = $this->jsonapi;
    }
}
