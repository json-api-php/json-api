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

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\Document\Resource\IdentifiableResource;
use JsonApiPhp\JsonApi\HasLinksAndMeta;

final class Document implements \JsonSerializable
{
    const MEDIA_TYPE = 'application/vnd.api+json';
    const DEFAULT_API_VERSION = '1.0';

    use HasLinksAndMeta;

    private $data;
    private $errors;
    private $meta;
    private $json_api;
    private $links;
    private $included;
    private $is_sparse = false;

    private function __construct()
    {
    }

    public static function fromMeta(array $meta): self
    {
        $doc = new self;
        $doc->replaceMeta($meta);
        return $doc;
    }

    public static function fromErrors(Error ...$errors): self
    {
        $doc = new self;
        $doc->errors = $errors;
        return $doc;
    }

    public static function fromResource(IdentifiableResource $data): self
    {
        $doc = new self;
        $doc->data = $data;
        return $doc;
    }

    public static function fromResources(IdentifiableResource ...$data): self
    {
        $doc = new self;
        $doc->data = $data;
        return $doc;
    }

    public function setApiVersion(string $version = self::DEFAULT_API_VERSION)
    {
        $this->json_api['version'] = $version;
    }

    public function setApiMeta(array $meta)
    {
        $this->json_api['meta'] = $meta;
    }

    public function setIncluded(IdentifiableResource ...$included)
    {
        $this->included = $included;
    }

    public function markSparse()
    {
        $this->is_sparse = true;
    }

    public function jsonSerialize()
    {
        $this->enforceFullLinkage();
        return array_filter(
            [
                'data' => $this->data,
                'errors' => $this->errors,
                'meta' => $this->meta,
                'jsonapi' => $this->json_api,
                'links' => $this->links,
                'included' => $this->included,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }

    private function enforceFullLinkage()
    {
        if ($this->is_sparse || empty($this->included)) {
            return;
        }
        foreach ($this->included as $included_resource) {
            if ($this->hasLinkTo($included_resource) || $this->anotherIncludedResourceIdentifies($included_resource)) {
                continue;
            }
            throw new \LogicException("Full linkage is required for $included_resource");
        }
    }

    private function anotherIncludedResourceIdentifies(IdentifiableResource $resource): bool
    {
        /** @var IdentifiableResource $included_resource */
        foreach ($this->included as $included_resource) {
            if ($included_resource !== $resource && $included_resource->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    private function hasLinkTo(IdentifiableResource $resource): bool
    {
        /** @var IdentifiableResource $my_resource */
        foreach ($this->toResources() as $my_resource) {
            if ($my_resource->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    private function toResources(): \Generator
    {
        if ($this->data instanceof IdentifiableResource) {
            yield $this->data;
        } elseif (is_array($this->data)) {
            foreach ($this->data as $datum) {
                yield $datum;
            }
        }
    }
}
