<?php
/**
 *  This file is part of JSON:API implementation for PHP.
 *
 *  (c) Alexey Karapetov <karapetov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource\Relationship;

use JsonApiPhp\JsonApi\Document\Resource\IdentifiableResource;
use JsonApiPhp\JsonApi\Document\Resource\ResourceId;

final class Linkage implements \JsonSerializable
{
    private $data;

    private function __construct()
    {
    }

    public static function nullLinkage(): self
    {
        return new self;
    }

    public static function emptyArrayLinkage(): self
    {
        $linkage = new self;
        $linkage->data = [];
        return $linkage;
    }

    public static function fromSingleResourceId(ResourceId $data): self
    {
        $linkage = new self;
        $linkage->data = $data;
        return $linkage;
    }

    public static function fromManyResourceIds(ResourceId ...$data): self
    {
        $linkage = new self;
        $linkage->data = $data;
        return $linkage;
    }

    public function isLinkedTo(IdentifiableResource $resource): bool
    {
        if ($this->data) {
            if ($this->data instanceof ResourceId) {
                return $this->data->isEqualTo($resource);
            }
            foreach ($this->data as $my_resource) {
                if ($resource->isEqualTo($my_resource)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function jsonSerialize()
    {
        return $this->data;
    }
}
