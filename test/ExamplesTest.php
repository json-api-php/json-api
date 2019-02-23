<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use PHPUnit\Framework\TestCase;

class ExamplesTest extends TestCase
{
    /**
     * @dataProvider examples
     * @param string $file
     */
    public function testOutputEncodesToJson(string $file)
    {
        $this->assertJson(`php $file`);
    }

    public function examples()
    {
        return [
            [__DIR__.'/../examples/compound_doc.php'],
            [__DIR__.'/../examples/simple_doc.php'],
        ];
    }
}
