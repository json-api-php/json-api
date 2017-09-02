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

namespace JsonApiPhp\JsonApi\Document\Resource;

final class NullResource implements ResourceInterface
{
    public function jsonSerialize()
    {
        return null;
    }

    public function identifies(ResourceInterface $resource): bool
    {
        return false;
    }

    /**
     * @deprecated to be removed in 1.0
     */
    public function __toString(): string
    {
        return 'null';
    }
}
