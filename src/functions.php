<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

function combine(Attachable ...$things): object
{
    $obj = (object) [];
    foreach ($things as $thing) {
        $thing->attachTo($obj);
    }
    return $obj;
}

function child(object $o, string $name): object
{
    if (empty($o->{$name})) {
        $o->{$name} = (object) [];
    }
    return $o->{$name};
}

function isValidName(string $name): bool
{
    return preg_match('/^(?=[^-_ ])[a-zA-Z0-9\x{0080}-\x{FFFF}-_ ]*(?<=[^-_ ])$/u', $name) === 1;
}
