<?php

/*
 * This file is part of graze/feed.
 *
 * Copyright (c) 2015 Nature Delivered Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/graze/feed/blob/master/LICENSE
 */

namespace Graze\Feed;

use LogicException;
use PHPUnit_Framework_TestCase as TestCase;

class RandomArticleFeedTest extends TestCase
{
    public function setUp()
    {
        $this->feed = new RandomArticleFeed([1,2,3]);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(RandomArticleFeed::class, $this->feed);
    }

    public function testSupportsFalseNotEnoughArticles()
    {
        $this->assertFalse($this->feed->supports(4));
    }

    public function testSupportsFalseNegativeValue()
    {
        $this->assertFalse($this->feed->supports(-3));
    }

    public function testSupportsTrueExactNumberArticles()
    {
        $this->assertTrue($this->feed->supports(3));
    }

    public function testSupportsTrueFewerArticles()
    {
        $this->assertTrue($this->feed->supports(2));
    }

    public function testSupplyThrowsWhenSupportsFalse()
    {
        $this->setExpectedException(LogicException::class);
        $this->feed->supply(4);
    }

    public function testSupplySuppliesRightNumber()
    {
        $this->assertCount(2, $this->feed->supply(2));
    }

    public function testSupplySuppliesCorrectArticles()
    {
        $this->assertEmpty(array_diff($this->feed->supply(2), [1,2,3]));
    }
}
