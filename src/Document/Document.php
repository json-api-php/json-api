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
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use JsonApiPhp\JsonApi\HasLinksAndMeta;

final class Document implements \JsonSerializable
{
    const MEDIA_TYPE = 'application/vnd.api+json';
    const DEFAULT_API_VERSION = '1.0';

    use HasLinksAndMeta;

    private $data;
    private $errors;
    private $meta;
    private $jsonapi;
    private $links;
    private $included;
    private $sparse = false;

    /**
     * Use named constructors instead
     */
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

    public function setApiVersion(string $version = self::DEFAULT_API_VERSION): void
    {
        $this->jsonapi['version'] = $version;
    }

    public function setApiMeta(array $meta): void
    {
        $this->jsonapi['meta'] = $meta;
    }

    public function setIncluded(IdentifiableResource ...$included)
    {
        $this->included = $included;
    }

    public function setSparse()
    {
        $this->sparse = true;
    }

    public function jsonSerialize()
    {
        if ($this->included && !$this->sparse) {
            foreach ($this->included as $resource) {
                if ($this->hasLinkTo($resource)) {
                    continue;
                }
                throw new \LogicException("Full linkage is required for $resource");
            }
        }
        return array_filter(
            [
                'data' => $this->data,
                'errors' => $this->errors,
                'meta' => $this->meta,
                'jsonapi' => $this->jsonapi,
                'links' => $this->links,
                'included' => $this->included,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }

    private function hasLinkTo(IdentifiableResource $resource): bool
    {
        if (!$this->data) {
            return false;
        }

        foreach ($this->toDataItems() as $my_resource) {

            if ($my_resource instanceof ResourceObject) {
                if ($my_resource->hasRelationTo($resource)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return IdentifiableResource[]
     */
    private function toDataItems(): array
    {
        if ($this->data instanceof IdentifiableResource) {
            return [$this->data];
        } elseif (is_array($this->data)) {
            return $this->data;
        } else {
            return [];
        }

    }
}
