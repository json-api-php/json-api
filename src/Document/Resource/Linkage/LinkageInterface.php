<?php declare(strict_types=1);
/**
 *  This file is part of JSON:API implementation for PHP.
 *
 *  (c) Alexey Karapetov <karapetov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace JsonApiPhp\JsonApi\Document\Resource\Linkage;

use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

interface LinkageInterface extends \JsonSerializable
{
    public function isLinkedTo(ResourceObject $resource): bool;

    public function jsonSerialize();
}
