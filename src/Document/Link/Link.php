<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

final class Link implements LinkInterface
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
