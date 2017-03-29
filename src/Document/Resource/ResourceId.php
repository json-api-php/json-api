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

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\HasMeta;

final class ResourceId extends IdentifiableResource
{
    use HasMeta;

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
