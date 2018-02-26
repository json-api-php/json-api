<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Error\ErrorMember;

final class Error extends JsonSerializableValue implements MandatoryErrorDocumentMember
{
    public function __construct(ErrorMember ...$members)
    {
        parent::__construct(combine(...$members));
    }

    public function attachTo(object $o)
    {
        $o->errors[] = $this;
    }
}
