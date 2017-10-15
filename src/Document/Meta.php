<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

class Meta implements \JsonSerializable
{
    private $data;

    public function __construct(\stdClass $data)
    {
        $this->validateObject($data);

        $this->data = $data;
    }

    public static function fromArray(array $array): self
    {
        return new self((object) $array);
    }

    public function jsonSerialize()
    {
        return $this->data;
    }

    private function validateObject($object)
    {
        foreach ($object as $name => $value) {
            if (is_string($name) && !$this->isValidMemberName($name)) {
                throw new \OutOfBoundsException("Not a valid attribute name '$name'");
            }

            if (is_array($value) || $value instanceof \stdClass) {
                $this->validateObject($value);
            }
        }
    }

    private function isValidMemberName(string $name): bool
    {
        return preg_match('/^(?=[^-_ ])[a-zA-Z0-9\x{0080}-\x{FFFF}-_ ]*(?<=[^-_ ])$/u', $name) === 1;
    }
}
