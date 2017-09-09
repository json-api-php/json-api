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

namespace JsonApiPhp\JsonApi\Document\Resource\Linkage;

use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

final class SingleLinkage implements LinkageInterface
{
    private $identifier;

    public function __construct(ResourceIdentifier $identifier)
    {
        $this->identifier = $identifier;
    }

    public function isLinkedTo(ResourceObject $resource): bool
    {
        return $this->identifier->identifies($resource);
    }

    public function jsonSerialize()
    {
        return $this->identifier;
    }
}
