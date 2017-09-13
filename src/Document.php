<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Document\Error;
use JsonApiPhp\JsonApi\Document\LinksTrait;
use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\MetaTrait;
use JsonApiPhp\JsonApi\Document\PrimaryData\MultiIdentifierData;
use JsonApiPhp\JsonApi\Document\PrimaryData\MultiResourceData;
use JsonApiPhp\JsonApi\Document\PrimaryData\NullData;
use JsonApiPhp\JsonApi\Document\PrimaryData\PrimaryDataInterface;
use JsonApiPhp\JsonApi\Document\PrimaryData\SingleIdentifierData;
use JsonApiPhp\JsonApi\Document\PrimaryData\SingleResourceData;
use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

class Document implements \JsonSerializable
{
    const MEDIA_TYPE = 'application/vnd.api+json';
    const DEFAULT_API_VERSION = '1.0';

    use LinksTrait;
    use MetaTrait;

    /**
     * @var PrimaryDataInterface
     */
    private $data;

    /**
     * @var Error[]
     */
    private $errors;

    private $api;

    /**
     * @var ResourceObject[]
     */
    private $included;
    private $sparse = false;

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

    public static function fromResource(ResourceObject $resource): self
    {
        $doc = new self;
        $doc->data = new SingleResourceData($resource);
        return $doc;
    }

    public static function fromResources(ResourceObject ...$resources): self
    {
        $doc = new self;
        $doc->data = new MultiResourceData(...$resources);
        return $doc;
    }

    public static function fromIdentifier(ResourceIdentifier $identifier)
    {
        $doc = new self;
        $doc->data = new SingleIdentifierData($identifier);
        return $doc;
    }

    public static function fromIdentifiers(ResourceIdentifier... $identifiers)
    {
        $doc = new self;
        $doc->data = new MultiIdentifierData(...$identifiers);
        return $doc;
    }

    public static function nullDocument()
    {
        $doc = new self;
        $doc->data = new NullData();
        return $doc;
    }

    public function setApiVersion(string $version = self::DEFAULT_API_VERSION)
    {
        $this->api['version'] = $version;
    }

    public function setApiMeta(Meta $meta)
    {
        $this->api['meta'] = $meta;
    }

    public function setIncluded(ResourceObject ...$resources)
    {
        if (null === $this->data) {
            throw new \LogicException('Document with no data cannot contain included resources');
        }
        foreach ($resources as $resource) {
            if (isset($this->included[(string) $resource->toIdentifier()])) {
                throw new \LogicException("Resource {$resource->toIdentifier()} is already included");
            }
            $this->included[(string) $resource->toIdentifier()] = $resource;
        }
    }

    public function markSparse()
    {
        $this->sparse = true;
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
                'included' => $this->included ? array_values($this->included) : null,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }

    private function enforceFullLinkage()
    {
        if ($this->sparse || empty($this->included)) {
            return;
        }
        foreach ($this->included as $included) {
            if ($this->data->hasLinkTo($included)) {
                continue;
            }
            foreach ($this->included as $anotherIncluded) {
                if ($anotherIncluded->identifies($included)) {
                    continue 2;
                }
            }
            throw new \LogicException("Full linkage is required for {$included->toIdentifier()}");
        }
    }
}
