<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

final class JsonApi implements MetaDocumentMember, DataDocumentMember
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

    public function attachTo(object $o)
    {
        $o->jsonapi = $this->jsonapi;
    }
}
