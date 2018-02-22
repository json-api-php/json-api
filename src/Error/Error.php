<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\JsonSerializableValue;
use JsonApiPhp\JsonApi\MandatoryErrorDocumentMember;
use function JsonApiPhp\JsonApi\combine;

final class Error extends JsonSerializableValue implements MandatoryErrorDocumentMember
{
    public function __construct(ErrorMember ...$errors)
    {
        parent::__construct(combine(...$errors));
    }

    public function attachTo(object $o)
    {
        $o->errors[] = $this;
    }
}
