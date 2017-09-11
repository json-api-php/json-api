<?php
/**
 *  This file is part of JSON:API implementation for PHP.
 *
 *  (c) Alexey Karapetov <karapetov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource\Relationship;

use JsonApiPhp\JsonApi\Document\Link\LinkInterface;
use JsonApiPhp\JsonApi\Document\LinksTrait;
use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\MetaTrait;
use JsonApiPhp\JsonApi\Document\Resource\Linkage\LinkageInterface;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

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

    public static function fromMeta(Meta $meta): self
    {
        $r = new self;
        $r->setMeta($meta);
        return $r;
    }

    public static function fromSelfLink(LinkInterface $link): self
    {
        $r = new self;
        $r->setLinkObject('self', $link);
        return $r;
    }

    public static function fromRelatedLink(LinkInterface $link): self
    {
        $r = new self;
        $r->setLinkObject('related', $link);
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
        return array_filter(
            [
                'data' => $this->linkage,
                'links' => $this->links,
                'meta' => $this->meta,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }
}
