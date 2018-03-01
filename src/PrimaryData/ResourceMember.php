<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\Attachable;
use JsonApiPhp\JsonApi\ResourceObject\FieldRegistry;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

/**
 * @internal
 */
interface ResourceMember extends Attachable
{
    public function registerResourceField(FieldRegistry $registry);
    public function registerIdentifier(IdentifierRegistry $registry);
}
