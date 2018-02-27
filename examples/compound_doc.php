<?php declare(strict_types=1);
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\CompoundDocument;
use JsonApiPhp\JsonApi\Included;
use JsonApiPhp\JsonApi\Link\LastLink;
use JsonApiPhp\JsonApi\Link\NextLink;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\MultiLinkage;
use JsonApiPhp\JsonApi\Relationship;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\ResourceObjectSet;
use JsonApiPhp\JsonApi\SingleLinkage;

require_once __DIR__.'/../vendor/autoload.php';

$dan = new ResourceObject(
    'people',
    '9',
    new Attribute('first-name', 'Dan'),
    new Attribute('last-name', 'Gebhardt'),
    new Attribute('twitter', 'dgeb'),
    new SelfLink(new Url('http://example.com/people/9'))
);

$comment05 = new ResourceObject(
    'comments',
    '5',
    new Attribute('body', 'First!'),
    new SelfLink(new Url('http://example.com/comments/5')),
    new Relationship('author', new SingleLinkage(new ResourceIdentifier('people', '2')))

);
$comment12 = new ResourceObject(
    'comments',
    '12',
    new Attribute('body', 'I like XML better'),
    new SelfLink(new Url('http://example.com/comments/12')),
    new Relationship('author', new SingleLinkage($dan->identifier()))
);

$document = new CompoundDocument(
    new ResourceObjectSet(
        new ResourceObject(
            'articles',
            '1',
            new Attribute('title', 'JSON API paints my bikeshed!'),
            new SelfLink(new Url('http://example.com/articles/1')),
            new Relationship(
                'author',
                new SingleLinkage($dan->identifier()),
                new SelfLink(new Url('http://example.com/articles/1/relationships/author')),
                new RelatedLink(new Url('http://example.com/articles/1/author'))
            ),
            new Relationship(
                'comments',
                new MultiLinkage(
                    $comment05->identifier(),
                    $comment12->identifier()
                ),
                new SelfLink(new Url('http://example.com/articles/1/relationships/comments')),
                new RelatedLink(new Url('http://example.com/articles/1/comments'))
            )
        )
    ),
    new Included($dan, $comment05, $comment12),
    new SelfLink(new Url('http://example.com/articles')),
    new NextLink(new Url('http://example.com/articles?page[offset]=2')),
    new LastLink(new Url('http://example.com/articles?page[offset]=10'))
);

echo json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
