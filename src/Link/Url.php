<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

final class Url implements \JsonSerializable, Link
{
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function jsonSerialize()
    {
        return $this->url;
    }
}
