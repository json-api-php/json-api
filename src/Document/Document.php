<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\HasLinksAndMeta;

final class Document implements \JsonSerializable
{
    const MEDIA_TYPE = 'application/vnd.api+json';
    const DEFAULT_API_VERSION = '1.0';

    use HasLinksAndMeta;

    protected $data;
    protected $errors;
    protected $meta;
    protected $jsonapi;
    protected $links;

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

    public static function fromData(PrimaryData $data): self
    {
        $doc = new self;
        $doc->data = $data;
        return $doc;
    }

    public static function fromDataItems(PrimaryDataItem ...$data): self
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

    public function jsonSerialize()
    {
        return array_filter(
            [
                'data'    => $this->data,
                'errors'  => $this->errors,
                'meta'    => $this->meta,
                'jsonapi' => $this->jsonapi,
                'links'   => $this->links,
            ],
            function ($v) {
                return null !== $v;
            }
        );
    }
}
