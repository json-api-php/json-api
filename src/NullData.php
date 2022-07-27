<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class NullData implements PrimaryData {
    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $o->data = null;
    }
}
