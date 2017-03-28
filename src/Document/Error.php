<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\HasMeta;

final class Error implements \JsonSerializable
{
    use HasMeta;

    private $id;
    private $links;
    private $status;
    private $code;
    private $title;
    private $detail;
    private $source;
    private $meta;

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setAboutLink(string $link): void
    {
        $this->links['about'] = $link;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDetail(string $detail): void
    {
        $this->detail = $detail;
    }

    public function setSourcePointer(string $pointer): void
    {
        $this->source['pointer'] = $pointer;
    }

    public function setSourceParameter(string $parameter): void
    {
        $this->source['parameter'] = $parameter;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'id'     => $this->id,
                'links'  => $this->links,
                'status' => $this->status,
                'code'   => $this->code,
                'title'  => $this->title,
                'detail' => $this->detail,
                'source' => $this->source,
                'meta'   => $this->meta,
            ],
            function ($v) {
                return null !== $v;
            }
        ) ?: (object)[];
    }
}
