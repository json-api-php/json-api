<?php
/**
 * This file is part of JSON:API implementation for PHP.
 *
 * (c) Alexey Karapetov <karapetov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\PrimaryData;

use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

final class MultiResourceData implements PrimaryDataInterface
{
    private $resources;

    public function __construct(ResourceObject ...$resources)
    {
        $this->resources = $resources;
    }

    public function hasLinkTo(ResourceObject $resource): bool
    {
        foreach ($this->resources as $myResource) {
            if ($myResource->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    public function jsonSerialize()
    {
        return $this->resources;
    }
}
