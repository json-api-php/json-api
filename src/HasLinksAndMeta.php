<?php
/**
 *
 *  * This file is part of JSON:API implementation for PHP.
 *  *
 *  * (c) Alexey Karapetov <karapetov@gmail.com>
 *  *
 *  * For the full copyright and license information, please view the LICENSE
 *  * file that was distributed with this source code.
 *
 */

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

trait HasLinksAndMeta
{
    use HasLinks;
    use HasMeta;
}
