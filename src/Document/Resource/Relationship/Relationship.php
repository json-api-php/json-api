<?php
/**
 *
 *  * This file is part of JSON:API implementation for PHP.
 *  *
 *  * (c) Alexey Karapetov <karapetov@gmail.com>
 *  *
 *  * For the full copyright and license information, please view the LICENSE
 *  * file that was distributed with this source code.
 *
 */

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource\Relationship;

use JsonApiPhp\JsonApi\Document\Resource\IdentifiableResource;
use JsonApiPhp\JsonApi\HasLinksAndMeta;

final class Relationship implements \JsonSerializable
{
    use HasLinksAndMeta;

    /**
     * @var Linkage
     */
    private $linkage = null;
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

    public static function fromLinkage(Linkage $linkage): self
    {
        $r = new self;
        $r->linkage = $linkage;
        return $r;
    }

    public function hasLinkageTo(IdentifiableResource $resource): bool
    {
        return ($this->linkage && $this->linkage->isLinkedTo($resource));
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'data'  => $this->linkage,
                'links' => $this->links,
                'meta'  => $this->meta,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }
}
