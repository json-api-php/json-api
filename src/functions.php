<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Document\Attachable;

function isValidMemberName(string $name): bool
{
    return preg_match('/^(?=[^-_ ])[a-zA-Z0-9\x{0080}-\x{FFFF}-_ ]*(?<=[^-_ ])$/u', $name) === 1;
}

function combine(Attachable ...$things): object
{
    $obj = (object)[];
    foreach ($things as $thing) {
        $thing->attachTo($obj);
    }
    return $obj;
}