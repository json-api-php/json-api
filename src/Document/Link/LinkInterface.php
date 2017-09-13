<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

interface LinkInterface extends \JsonSerializable
{
    public function jsonSerialize();
}
