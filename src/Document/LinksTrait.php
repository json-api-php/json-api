<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\Document\Link\Link;
use JsonApiPhp\JsonApi\Document\Link\LinkInterface;

trait LinksTrait
{
    /**
     * @var LinkInterface[]
     */
    protected $links;

    public function setLink(string $name, string $url)
    {
        $this->links[$name] = new Link($url);
    }

    public function setLinkObject(string $name, LinkInterface $link)
    {
        $this->links[$name] = $link;
    }
}
