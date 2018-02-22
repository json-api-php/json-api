<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Document\Meta;

class LinkObject
    extends JsonSerializableValue
    implements Link
{
    public function __construct(string $href, Meta $meta = null)
    {
        $link = (object)[
            'href' => $href
        ];
        if ($meta) {
            $meta->attachTo($link);
        }
        parent::__construct($link);
    }
}