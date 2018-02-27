<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

final class JsonApi extends AttachableValue implements TopLevelDocumentMember, DataDocumentMember
{
    public function __construct(string $version = '1.0', Meta $meta = null)
    {
        $jsonapi = (object) [
            'version' => $version,
        ];
        if ($meta) {
            $meta->attachTo($jsonapi);
        }
        parent::__construct('jsonapi', $jsonapi);
    }
}
