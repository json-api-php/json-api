<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Document\AttachableValue;

abstract class NamedLink
    extends AttachableValue
{
    public function __construct(string $name, Link $link)
    {
        parent::__construct($name, $link);
    }

    function attachTo(object $o)
    {
        if (!isset($o->links)) {
            $o->links = (object)[];
        }
        parent::attachTo($o->links);
    }
}