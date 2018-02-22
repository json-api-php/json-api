<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

class ResourceIdentifier
    extends AttachableValue
    implements PrimaryData
{
    public function __construct(string $type, string $id)
    {
        $obj = (object)[
            'type' => $type,
            'id' => $id
        ];
        parent::__construct('data', $obj);
    }
}