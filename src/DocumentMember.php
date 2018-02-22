<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

interface DocumentMember extends \JsonSerializable
{
    public function name(): string;
}