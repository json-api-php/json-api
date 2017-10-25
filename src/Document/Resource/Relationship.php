<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource;

use JsonApiPhp\JsonApi\Document\LinksTrait;
use JsonApiPhp\JsonApi\Document\MetaTrait;
use JsonApiPhp\JsonApi\Document\Resource\Linkage\LinkageInterface;
use function JsonApiPhp\JsonApi\filterNulls;

final class Relationship implements \JsonSerializable
{
    use LinksTrait;
    use MetaTrait;

    /**
     * @var LinkageInterface
     */
    private $linkage = null;

    private function __construct()
    {
    }

    public static function fromMeta(iterable $meta): self
    {
        $r = new self;
        $r->setMeta($meta);
        return $r;
    }

    public static function fromSelfLink(string $url, iterable $meta = null): self
    {
        $r = new self;
        $r->setLink('self', $url, $meta);
        return $r;
    }

    public static function fromRelatedLink(string $url, iterable $meta = null): self
    {
        $r = new self;
        $r->setLink('related', $url, $meta);
        return $r;
    }

    public static function fromLinkage(LinkageInterface $linkage): self
    {
        $r = new self;
        $r->linkage = $linkage;
        return $r;
    }

    public function hasLinkageTo(ResourceObject $resource): bool
    {
        return ($this->linkage && $this->linkage->isLinkedTo($resource));
    }

    public function jsonSerialize()
    {
        return filterNulls([
            'data' => $this->linkage,
            'links' => $this->links,
            'meta' => $this->meta,
        ]);
    }
}
