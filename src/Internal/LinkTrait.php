<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

use JsonApiPhp\JsonApi\Meta;

/**
 * @internal
 */
trait LinkTrait {
    private string|object $link;

    public function __construct(string $url, Meta ...$metas) {
        if ($metas) {
            $this->link = (object)['href' => $url];
            foreach ($metas as $meta) {
                $meta->attachTo($this->link);
            }
        } else {
            $this->link = $url;
        }
    }
}
