<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

trait LinksTrait
{
    /**
     * @var Container
     */
    protected $links;

    public function setLink(string $name, string $url, iterable $meta = null)
    {
        $this->links = $this->links ?: new Container();
        $this->links->set($name, $meta ? ['meta' => new Container($meta), 'href' => $url] : $url);
    }
}
