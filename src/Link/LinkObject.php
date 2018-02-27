<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Meta;

final class LinkObject implements \JsonSerializable, Link
{
    private $link;

    public function __construct(string $href, Meta $meta = null)
    {
        $this->link = (object) [
            'href' => $href,
        ];
        if ($meta) {
            $meta->attachTo($this->link);
        }
    }

    public function jsonSerialize()
    {
        return $this->link;
    }
}
