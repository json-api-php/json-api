<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Error\Member;

final class Error extends JsonSerializableValue implements ErrorDocumentMember
{
    public function __construct(Member ...$members)
    {
        parent::__construct(combine(...$members));
    }

    public function attachTo(object $o)
    {
        $o->errors[] = $this;
    }
}
