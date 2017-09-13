<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\Meta;

final class LinkObject implements LinkInterface
{
    private $link;

    public function __construct(string $href, Meta $meta = null)
    {
        $this->link['href'] = $href;
        if ($meta) {
            $this->link['meta'] = $meta;
        }
    }

    public function jsonSerialize()
    {
        return $this->link;
    }
}
