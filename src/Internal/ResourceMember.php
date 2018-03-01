<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface ResourceMember extends Attachable, Identifier
{
    public function registerField(FieldRegistry $registry);
}
