<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;

final class Included extends AttachableValue implements DataDocumentMember
{
    private $resources = [];

    public function __construct(ResourceObject ...$resources)
    {
        parent::__construct('included', $resources);
        $this->resources = $resources;
    }
}
