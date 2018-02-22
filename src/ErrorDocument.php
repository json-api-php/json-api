<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

final class ErrorDocument
    extends JsonSerializableValue
{
    public function __construct(MandatoryErrorDocumentMember $error, ErrorDocumentMember ...$members)
    {
        parent::__construct(combine($error, ...$members));
    }
}