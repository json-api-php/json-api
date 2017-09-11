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

namespace JsonApiPhp\JsonApi\Document;

class Meta implements \JsonSerializable
{
    private $data;

    public function __construct(\stdClass $data)
    {
        $this->data = $data;
    }

    public static function fromArray(array $array): self
    {
        return new self((object) $array);
    }

    public function jsonSerialize()
    {
        return $this->data;
    }
}
