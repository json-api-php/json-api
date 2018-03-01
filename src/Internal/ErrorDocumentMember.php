<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface ErrorDocumentMember
{
    public function attachTo(object $o);
}
