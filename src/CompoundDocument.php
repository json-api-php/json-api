<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class CompoundDocument extends JsonSerializableValue
{
    public function __construct(PrimaryData $data, Included $included, DataDocumentMember ...$members)
    {
        foreach ($included as $resource) {
            if ($data->identifies($resource)) {
                continue;
            }
            foreach ($included as $anotherResource) {
                if ($anotherResource->identifies($resource)) {
                    continue 2;
                }
            }
            throw new \DomainException('Full linkage required for '.json_encode($resource->identifier()));
        }
        parent::__construct(combine($data, $included, ...$members));
    }
}
