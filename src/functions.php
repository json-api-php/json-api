<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

function isValidMemberName(string $name): bool
{
    return preg_match('/^(?=[^-_ ])[a-zA-Z0-9\x{0080}-\x{FFFF}-_ ]*(?<=[^-_ ])$/u', $name) === 1;
}

function isValidResourceType(string $name): bool
{
    /**
     * The values of type members MUST adhere to the same constraints as member names.
     * @see http://jsonapi.org/format/#document-resource-object-identification
     */
    return isValidMemberName($name);
}

function filterNulls(array $a): array
{
    return array_filter($a, function ($v) {
        return $v !== null;
    });
}
