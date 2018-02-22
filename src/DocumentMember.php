<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Document\Attachable;

interface DocumentMember
    extends \JsonSerializable, Attachable
{
}