<?php

namespace Graze\Feed;

use LogicException;
use PHPUnit_Framework_TestCase as TestCase;

class ArticleFeedTest extends TestCase
{
    public function setUp()
    {
        $this->feed = new ArticleFeed([1,2,3]);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(ArticleFeed::class, $this->feed);
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
        $this->assertEquals([1,2], $this->feed->supply(2));
    }
}
