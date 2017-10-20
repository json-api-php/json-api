<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\Document\Link\Link;
use JsonApiPhp\JsonApi\Document\Link\LinkInterface;

trait LinksTrait
{
    /**
     * @var Container|null
     */
    protected $links;

    public function setLink(string $name, string $url)
    {
        $this->init();
        $this->links->set(new MemberName($name),  new Link($url));
    }

    public function setLinkObject(string $name, LinkInterface $link)
    {
        $this->init();
        $this->links->set(new MemberName($name), $link);
    }

    private function init()
    {
        if (!$this->links) {
            $this->links = new Container();
        }
    }
}
