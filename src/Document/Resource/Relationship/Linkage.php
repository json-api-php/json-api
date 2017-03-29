<?php
/**
 *
 *  * This file is part of JSON:API implementation for PHP.
 *  *
 *  * (c) Alexey Karapetov <karapetov@gmail.com>
 *  *
 *  * For the full copyright and license information, please view the LICENSE
 *  * file that was distributed with this source code.
 *
 */

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource\Relationship;

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

    public static function emptyArrayLinkage()
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

    public function jsonSerialize()
    {
        return $this->data;
    }
}
