<?php declare(strict_types=1);

use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\CompoundDocument;
use JsonApiPhp\JsonApi\Included;
use JsonApiPhp\JsonApi\Link\LastLink;
use JsonApiPhp\JsonApi\Link\NextLink;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\PaginatedCollection;
use JsonApiPhp\JsonApi\Pagination;
use JsonApiPhp\JsonApi\ResourceCollection;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceIdentifierCollection;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\ToMany;
use JsonApiPhp\JsonApi\ToOne;

require_once __DIR__.'/../vendor/autoload.php';

$dan = new ResourceObject(
    'people',
    '9',
    new Attribute('first-name', 'Dan'),
    new Attribute('last-name', 'Gebhardt'),
    new Attribute('twitter', 'dgeb'),
    new SelfLink('http://example.com/people/9')
);

$comment05 = new ResourceObject(
    'comments',
    '5',
    new Attribute('body', 'First!'),
    new SelfLink('http://example.com/comments/5'),
    new ToOne('author', new ResourceIdentifier('people', '2'))

);
$comment12 = new ResourceObject(
    'comments',
    '12',
    new Attribute('body', 'I like XML better'),
    new SelfLink('http://example.com/comments/12'),
    new ToOne('author', $dan->identifier())
);

$document = new CompoundDocument(
    new PaginatedCollection(
        new Pagination(
            new NextLink('http://example.com/articles?page[offset]=2'),
            new LastLink('http://example.com/articles?page[offset]=10')
        ),
        new ResourceCollection(
            new ResourceObject(
                'articles',
                '1',
                new Attribute('title', 'JSON API paints my bikeshed!'),
                new SelfLink('http://example.com/articles/1'),
                new ToOne(
                    'author',
                    $dan->identifier(),
                    new SelfLink('http://example.com/articles/1/relationships/author'),
                    new RelatedLink('http://example.com/articles/1/author')
                ),
                new ToMany(
                    'comments',
                    new ResourceIdentifierCollection(
                        $comment05->identifier(),
                        $comment12->identifier()
                    ),
                    new SelfLink('http://example.com/articles/1/relationships/comments'),
                    new RelatedLink('http://example.com/articles/1/comments')
                )
            )
        )
    ),
    new Included($dan, $comment05, $comment12),
    new SelfLink('http://example.com/articles')
);

echo json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
