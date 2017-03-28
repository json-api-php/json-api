<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource\Relationship;

use JsonApiPhp\JsonApi\HasLinksAndMeta;

final class Relationship implements \JsonSerializable
{
    use HasLinksAndMeta;

    private $data;
    private $meta;
    private $links;

    private function __construct()
    {
    }

    public static function fromMeta(array $meta): self
    {
        $r = new self;
        $r->replaceMeta($meta);
        return $r;
    }

    public static function fromSelfLink(string $link, array $meta = null): self
    {
        $r = new self;
        $r->setLink('self', $link, $meta);
        return $r;
    }

    public static function fromRelatedLink(string $link, array $meta = null): self
    {
        $r = new self;
        $r->setLink('related', $link, $meta);
        return $r;
    }

    public static function fromLinkage(Linkage $data): self
    {
        $r = new self;
        $r->data = $data;
        return $r;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'data'  => $this->data,
                'links' => $this->links,
                'meta'  => $this->meta,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }
}
