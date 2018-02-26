<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

final class ErrorDocument extends JsonSerializableValue
{
    public function __construct(Error $error, ErrorDocumentMember ...$members)
    {
        parent::__construct(combine($error, ...$members));
    }
}
