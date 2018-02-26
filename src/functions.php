<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

function combine(Attachable ...$things): object
{
    $obj = (object) [];
    foreach ($things as $thing) {
        $thing->attachTo($obj);
    }
    return $obj;
}
