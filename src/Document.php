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

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Document\Error;
use JsonApiPhp\JsonApi\Document\LinksTrait;
use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\MetaTrait;
use JsonApiPhp\JsonApi\Document\Resource\ResourceInterface;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

class Document implements \JsonSerializable
{
    const MEDIA_TYPE = 'application/vnd.api+json';
    const DEFAULT_API_VERSION = '1.0';

    use LinksTrait;
    use MetaTrait;

    private $data;
    private $errors;
    private $api;
    private $included;
    private $is_sparse = false;

    private function __construct()
    {
    }

    public static function fromMeta(Meta $meta): self
    {
        $doc = new self;
        $doc->setMeta($meta);
        return $doc;
    }

    public static function fromErrors(Error ...$errors): self
    {
        $doc = new self;
        $doc->errors = $errors;
        return $doc;
    }

    public static function fromResource(ResourceInterface $data): self
    {
        $doc = new self;
        $doc->data = $data;
        return $doc;
    }

    public static function fromResources(ResourceInterface ...$data): self
    {
        $doc = new self;
        $doc->data = $data;
        return $doc;
    }

    public function setApiVersion(string $version = self::DEFAULT_API_VERSION)
    {
        $this->api['version'] = $version;
    }

    public function setApiMeta(array $meta)
    {
        $this->api['meta'] = $meta;
    }

    public function setIncluded(ResourceObject ...$included)
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
                'jsonapi' => $this->api,
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

    private function anotherIncludedResourceIdentifies(ResourceObject $resource): bool
    {
        /** @var ResourceObject $included_resource */
        foreach ($this->included as $included_resource) {
            if ($included_resource !== $resource && $included_resource->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    private function hasLinkTo(ResourceObject $resource): bool
    {
        /** @var ResourceInterface $my_resource */
        foreach ($this->toResources() as $my_resource) {
            if ($my_resource->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    private function toResources(): \Iterator
    {
        if ($this->data instanceof ResourceInterface) {
            yield $this->data;
        } elseif (is_array($this->data)) {
            foreach ($this->data as $datum) {
                yield $datum;
            }
        }
    }
}
