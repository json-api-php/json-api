<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class CompoundDocument extends JsonSerializableValue
{
    public function __construct(PrimaryData $data, Included $included, DataDocumentMember ...$members)
    {
        $this->enforceFullLinkage($data, $included);
        parent::__construct(combine($data, $included, ...$members));
    }

    private function enforceFullLinkage(PrimaryData $data, Included $included)
    {
    }
}
