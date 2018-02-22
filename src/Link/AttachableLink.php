<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\AttachableValue;

/**
 * @internal
 */
class AttachableLink
    extends AttachableValue
{
    public function __construct(string $key, Link $link)
    {
        parent::__construct($key, $link);
    }

    function attachTo(object $o)
    {
        if (!isset($o->links)) {
            $o->links = (object)[];
        }
        parent::attachTo($o->links);
    }
}