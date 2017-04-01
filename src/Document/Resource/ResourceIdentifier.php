<?php
declare(strict_types=1);

/*
 * This file is part of JSON:API implementation for PHP.
 *
 * (c) Alexey Karapetov <karapetov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\MetaTrait;

class ResourceIdentifier implements ResourceInterface
{
    use MetaTrait;

    protected $type;
    protected $id;

    public function __construct(string $type, string $id = null, array $meta = [])
    {
        $this->type = $type;
        $this->id = $id;
        $this->replaceMeta($meta);
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'type' => $this->type,
                'id' => $this->id,
                'meta' => $this->meta,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }

    public function __toString(): string
    {
        return sprintf("%s:%s", $this->type, $this->id ?: 'null');
    }

    public function identifies(ResourceInterface $resource): bool
    {
        return $resource instanceof self
            && $this->type === $resource->type
            && $this->id !== null
            && $this->id === $resource->id;
    }
}
