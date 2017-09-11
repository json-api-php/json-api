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

namespace JsonApiPhp\JsonApi\Document\Link;

use JsonApiPhp\JsonApi\Document\Meta;

final class LinkObject implements LinkInterface
{
    private $link;

    public function __construct(string $href, Meta $meta = null)
    {
        $this->link['href'] = $href;
        if ($meta) {
            $this->link['meta'] = $meta;
        }
    }

    public function jsonSerialize()
    {
        return $this->link;
    }
}
