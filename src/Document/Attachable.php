<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

interface Attachable
{
    function attachTo(object $o);
}