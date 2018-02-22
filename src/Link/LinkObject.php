<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\JsonSerializableValue;
use JsonApiPhp\JsonApi\Meta;

final class LinkObject
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