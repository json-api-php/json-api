<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\DataDocumentMember;
use JsonApiPhp\JsonApi\ToOneMember;

final class LastLink extends Link implements DataDocumentMember, ToOneMember
{
    protected $name = 'last';
}
