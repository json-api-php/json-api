<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;

class Url extends JsonSerializableValue implements Link
{
    public function __construct(string $url)
    {
        parent::__construct($url);
    }
}