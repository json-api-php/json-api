<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\ResourceObject\FieldRegistry;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

/**
 * @internal
 */
trait ResourceMemberTrait
{
    public function registerField(FieldRegistry $registry)
    {
    }

    public function registerAsIdentifier(IdentifierRegistry $registry)
    {
    }
}
