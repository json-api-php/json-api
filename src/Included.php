<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;

class Included extends AttachableValue implements DataDocumentMember
{
    public function __construct(ResourceObject ...$resources)
    {
        parent::__construct('included', $resources);
    }
}
