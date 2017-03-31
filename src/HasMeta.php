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

namespace JsonApiPhp\JsonApi;

trait HasMeta
{
    public function setMeta(string $key, $val)
    {
        $this->meta[$key] = $val;
    }

    public function replaceMeta(array $meta)
    {
        $this->meta = null;
        foreach ($meta as $key => $value) {
            $this->setMeta($key, $value);
        }
    }
}
