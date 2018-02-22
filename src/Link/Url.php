<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\JsonSerializableValue;

final class Url extends JsonSerializableValue implements Link
{
    public function __construct(string $url)
    {
        parent::__construct($url);
    }
}
