<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Attachable;

function combine(Attachable ...$members)
{
    $obj = (object) [];
    foreach ($members as $member) {
        $member->attachTo($obj);
    }
    return $obj;
}

function child($o, string $name)
{
    if (!isset($o->{$name})) {
        $o->{$name} = (object) [];
    }
    return $o->{$name};
}

function isValidName(string $name): bool
{
    return preg_match('/^(?=[^-_ ])[a-zA-Z0-9\x{0080}-\x{FFFF}-_ ]*(?<=[^-_ ])$/u', $name) === 1;
}

function compositeKey(string $type, string $id): string
{
    return "{$type}:{$id}";
}
