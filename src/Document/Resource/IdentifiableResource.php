<?php
/**
 *  This file is part of JSON:API implementation for PHP.
 *
 *  (c) Alexey Karapetov <karapetov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace JsonApiPhp\JsonApi\Document\Resource;

abstract class IdentifiableResource implements \JsonSerializable
{
    protected $id;
    protected $type;

    /**
     * Does this resource identify
     * @param IdentifiableResource $that
     * @return bool
     */
    abstract public function identifies(IdentifiableResource $that): bool;

    public function isEqualTo(IdentifiableResource $that): bool
    {
        return $this->type === $that->type && $this->id === $that->id;
    }

    public function __toString(): string
    {
        return "$this->type:$this->id";
    }
}
