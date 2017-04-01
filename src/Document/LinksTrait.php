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

namespace JsonApiPhp\JsonApi\Document;

trait LinksTrait
{
    protected $links;

    public function setLink(string $name, string $value, array $meta = null)
    {
        $this->links[$name] = $meta ? ['href' => $value, 'meta' => $meta] : $value;
    }
}
