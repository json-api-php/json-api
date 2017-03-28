<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\PrimaryData;
use JsonApiPhp\JsonApi\Document\PrimaryDataItem;
use JsonApiPhp\JsonApi\HasMeta;

final class ResourceId implements PrimaryData, PrimaryDataItem
{
    use HasMeta;

    private $type;
    private $id;
    private $meta;

    public function __construct(string $type, string $id = null, array $meta = [])
    {
        $this->type = $type;
        $this->id = $id;
        foreach ($meta as $k => $v) {
            $this->setMeta($k, $v);
        }
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'type' => $this->type,
                'id'   => $this->id,
                'meta' => $this->meta,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }
}
