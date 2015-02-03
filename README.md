# graze/feed

[![Latest Stable Version](http://img.shields.io/packagist/v/graze/feed.svg?style=flat)](https://packagist.org/packages/graze/feed)
[![Build Status](http://img.shields.io/travis/graze/feed/master.svg?style=flat)](https://travis-ci.org/graze/feed)
![Minimum PHP Version](http://img.shields.io/badge/php-~5.4-8892BF.svg?style=flat)

This is a very simple library designed to facilitate the implementation of simple, lightweight article feeds, where articles can be anything you like.

It can be installed in whichever way you prefer, but we recommend [Composer](https://packagist.org/packages/graze/feed).

````bash
$ composer require graze/feed
````

## The interface

The core of the library is `Graze\Feed\FeedInterface` which looks like this:

````php
interface FeedInterface
{
    /**
     * @param integer $number
     * @return boolean
     */
    public function supports($number);

    /**
     * @param integer $number
     * @return array
     */
    public function supply($number);
}
````

The idea being that any feed which you create can be queried to see if it supports a given number of articles (`supports($number)`) and, if so, can supply those articles (`supply($number)`).

## The abstract class

The `Graze\Feed\AbstractFeed` class is designed to let you implement a single protected method (`getArticles`) and then handles some boilerplate around 'supporting' and 'supplying' these articles.
N.B. this class will throw a `LogicException` if you request more articles than are supported by its `supports` method - always check if the feed 'supports' a given number of articles before telling it to give you them.


## Some batteries included

There's also an implementation of a basic article feed, and a random article feed, as well as a stack feed, that takes an array of `Graze\Feed\FeedInterface` as the only argument to its constructor and lets you create a meta-feed that will defer to each of the provided feeds in turn until it finds a supported one.

## Contributing

Contributions are accepted via Pull Request, but passing unit tests must be included before it will be considered for merge.

````bash
$ composer install
$ vendor/bin/phpunit
````

### License

The content of this library is released under the **MIT License** by **Nature Delivered Ltd.**.

You can find a copy of this license at http://www.opensource.org/licenses/mit or in [`LICENSE`][license].

[license]: https://github.com/graze/feed/blob/master/LICENSE
