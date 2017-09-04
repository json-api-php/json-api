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

use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

final class MultiIdentifierData implements PrimaryDataInterface
{
    private $identifiers;

    public function __construct(ResourceIdentifier ...$identifiers)
    {
        $this->identifiers = $identifiers;
    }

    public function hasLinkTo(ResourceObject $resource): bool
    {
        foreach ($this->identifiers as $identifier) {
            if ($identifier->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    public function jsonSerialize()
    {
        return $this->identifiers;
    }
}
