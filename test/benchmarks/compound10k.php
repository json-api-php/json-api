<?php declare(strict_types=1);

use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\CompoundDocument;
use JsonApiPhp\JsonApi\Error;
use JsonApiPhp\JsonApi\Error\Code;
use JsonApiPhp\JsonApi\Error\Detail;
use JsonApiPhp\JsonApi\Error\Id;
use JsonApiPhp\JsonApi\Error\Parameter;
use JsonApiPhp\JsonApi\Error\Pointer;
use JsonApiPhp\JsonApi\Error\Status;
use JsonApiPhp\JsonApi\Error\Title;
use JsonApiPhp\JsonApi\ErrorDocument;
use JsonApiPhp\JsonApi\Included;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\AboutLink;
use JsonApiPhp\JsonApi\Link\LastLink;
use JsonApiPhp\JsonApi\Link\NextLink;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\MultiLinkage;
use JsonApiPhp\JsonApi\Relationship;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\ResourceObjectSet;
use JsonApiPhp\JsonApi\SingleLinkage;

require_once __DIR__.'/../../vendor/autoload.php';

// Generate the compound document from the spec 10k times

for ($count = 0; $count < 10000; $count++) {
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

    $data_document = new CompoundDocument(
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

    $data_doc_json = json_encode($data_document);
}

for ($count = 0; $count < 1000; $count++) {
    $error_doc = new ErrorDocument(
        new Error(
            new Id('1'),
            new AboutLink(
                new Url('/errors/not_found')
            ),
            new Status('404'),
            new Code('not_found'),
            new Title('Resource not found'),
            new Detail('We tried hard but could not find anything'),
            new Pointer('/data'),
            new Parameter('query_string'),
            new Meta('purpose', 'test')
        ),
        new Meta('purpose', 'test'),
        new JsonApi()
    );

    $error_doc_json = json_encode($error_doc);
}

echo $data_doc_json;
echo "\n\n";
echo $error_doc_json;
