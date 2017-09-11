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

namespace JsonApiPhp\JsonApi\Document;

final class Error implements \JsonSerializable
{
    use MetaTrait;

    private $id;
    private $links;
    private $status;
    private $code;
    private $title;
    private $detail;
    private $source;

    /**
     * @param string $id
     */
    public function __construct(string $id = null)
    {
        $this->id = $id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function setAboutLink(string $link)
    {
        $this->links['about'] = $link;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setDetail(string $detail)
    {
        $this->detail = $detail;
    }

    public function setSourcePointer(string $pointer)
    {
        $this->source['pointer'] = $pointer;
    }

    public function setSourceParameter(string $parameter)
    {
        $this->source['parameter'] = $parameter;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'id' => $this->id,
                'links' => $this->links,
                'status' => $this->status,
                'code' => $this->code,
                'title' => $this->title,
                'detail' => $this->detail,
                'source' => $this->source,
                'meta' => $this->meta,
            ],
            function ($v) {
                return null !== $v;
            }
        ) ?: (object) [];
    }
}
