<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

abstract class SpecialValue implements \JsonSerializable
{
    private $val;

    public function __construct(string $val, string $errorMessage = "Invalid value '%s'")
    {
        if (!$this->isValidMemberNameOrTypeValue($val)) {
            throw new \OutOfBoundsException(sprintf($errorMessage, $val));
        }
        $this->val = $val;
    }

    public function jsonSerialize()
    {
        return $this->val;
    }

    public function __toString()
    {
        return $this->val;
    }

    protected function isValidMemberNameOrTypeValue(string $name): bool
    {
        return preg_match('/^(?=[^-_ ])[a-zA-Z0-9\x{0080}-\x{FFFF}-_ ]*(?<=[^-_ ])$/u', $name) === 1;
    }
}
