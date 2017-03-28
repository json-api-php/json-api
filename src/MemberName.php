<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

class MemberName
{
    private $name;

    public function __construct(string $name)
    {
        $this->validateName($name);
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @see http://jsonapi.org/format/#document-member-names
     * @param string $name
     */
    protected function validateName(string $name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Empty name');
        }
        foreach ([0, mb_strlen($name) - 1] as $pos) {
            if (!$this->isValidCode($this->unicodeOrd(mb_substr($name, $pos, 1)))) {
                throw new \InvalidArgumentException(sprintf('Invalid character at position %d', $pos));
            }
        }
        for ($pos = 1; $pos < mb_strlen($name) - 1; $pos++) {
            if (!$this->isValidMiddleCode($this->unicodeOrd(mb_substr($name, $pos, 1)))) {
                throw new \InvalidArgumentException(sprintf('Invalid character at position %d', $pos));
            }
        }
    }

    private function isValidCode(int $code): bool
    {
        return ($code >= 0x61 && $code <= 0x7A) // a-z
            || ($code >= 0x41 && $code <= 0x5A) // A-Z
            || ($code >= 0x30 && $code <= 0x39) // 0-9
            || ($code >= 0x80); // not recommended
    }

    private function isValidMiddleCode(int $code): bool
    {
        return self::isValidCode($code)
            || $code === 0x20   // <SPACE> is not recommended
            || $code === 0x2D   // -
            || $code === 0x5F;  // _
    }

    private function unicodeOrd(string $char): int
    {
        return unpack('V', iconv('UTF-8', 'UCS-4LE', $char))[1];
    }
}
