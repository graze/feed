<?php

namespace Graze\Feed;

use LogicException;
use PHPUnit_Framework_TestCase as TestCase;

class RandomFeedStackTest extends TestCase
{
    public function setUp()
    {
        $this->a = $this->getMock(FeedInterface::class);
        $this->b = $this->getMock(FeedInterface::class);
        $this->c = $this->getMock(FeedInterface::class);
        $this->feed = new RandomFeedStack([$this->a, $this->b, $this->c]);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(RandomFeedStack::class, $this->feed);
    }

    public function testSupportsFalseNoSupportingFeedInStack()
    {
        $this->a->expects($this->once())->method('supports')->with(4)->willReturn(false);
        $this->b->expects($this->once())->method('supports')->with(4)->willReturn(false);
        $this->c->expects($this->once())->method('supports')->with(4)->willReturn(false);

        $this->assertFalse($this->feed->supports(4));
    }

    public function testSupportsTrueAtLeastOneSupportingFeedInStack()
    {
        $this->a->expects($this->any())->method('supports')->with(7)->willReturn(false);
        $this->b->expects($this->once())->method('supports')->with(7)->willReturn(true);
        $this->c->expects($this->any())->method('supports')->with(7)->willReturn(false);

        $this->assertTrue($this->feed->supports(7));
    }


    public function testSupplyThrowsWhenSupportsFalse()
    {
        $this->setExpectedException(LogicException::class);
        $this->a->expects($this->once())->method('supports')->with(4)->willReturn(false);
        $this->b->expects($this->once())->method('supports')->with(4)->willReturn(false);
        $this->c->expects($this->once())->method('supports')->with(4)->willReturn(false);
        $this->feed->supply(4);
    }

    public function testSupplyDefersToTheCorrectFeedOneSupports()
    {
        $this->a->expects($this->once())->method('supports')->with(4)->willReturn(true);
        $this->b->expects($this->any())->method('supports')->with(4)->willReturn(false);
        $this->c->expects($this->any())->method('supports')->with(4)->willReturn(false);
        $this->a->expects($this->once())->method('supply')->with(4)->willReturn([1, 2, 3, 4]);

        $this->assertEquals([1, 2, 3, 4], $this->feed->supply(4));
    }
}
