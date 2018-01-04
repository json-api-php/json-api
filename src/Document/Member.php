<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

interface Member extends \JsonSerializable
{
    public function toName(): string;
}