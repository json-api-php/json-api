<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\ResourceObject;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\ResourceObject;

/**
 * @internal
 */
final class IdentifierRegistry implements Identifier
{
    /**
     * @var Identifier[]
     */
    private $identifiers = [];

    public function register(Identifier $identifier): void
    {
        $this->identifiers[] = $identifier;
    }

    public function identifies(ResourceObject $resource): bool
    {
        foreach ($this->identifiers as $identifier) {
            if ($identifier->identifies($resource)) {
                return true;
            }
        }
        return false;
    }
}