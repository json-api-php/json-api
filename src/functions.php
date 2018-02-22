<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

function isValidMemberName(string $name): bool
{
    return preg_match('/^(?=[^-_ ])[a-zA-Z0-9\x{0080}-\x{FFFF}-_ ]*(?<=[^-_ ])$/u', $name) === 1;
}

function indexedByName(DocumentMember ...$members): object
{
    return (object)array_reduce($members, function (array $c, DocumentMember $m) {
        $c[$m->name()] = $m;
        return $c;
    }, []);
}