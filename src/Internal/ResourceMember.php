<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface ResourceMember extends Attachable
{
    public function registerField(FieldRegistry $registry);

    public function registerIdentifier(IdentifierRegistry $registry);
}
