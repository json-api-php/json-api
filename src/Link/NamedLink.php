<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Document\Attachable;
use JsonApiPhp\JsonApi\Document\JsonSerializableValue;

abstract class NamedLink
    extends JsonSerializableValue
    implements Attachable
{
    private $name;

    public function __construct(string $name, Link $link)
    {
        parent::__construct($link);
        $this->name = $name;
    }

    function attachTo(object $o)
    {
        if (!isset($o->links)) {
            $o->links = (object)[];
        }
        $o->links->{$this->name} = $this;
    }
}