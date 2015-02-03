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

class FeedStackTest extends TestCase
{
    public function setUp()
    {
        $this->a = $this->getMock(FeedInterface::class);
        $this->b = $this->getMock(FeedInterface::class);
        $this->c = $this->getMock(FeedInterface::class);
        $this->feed = new FeedStack([$this->a, $this->b, $this->c]);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(FeedStack::class, $this->feed);
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
        $this->a->expects($this->once())->method('supports')->with(7)->willReturn(false);
        $this->b->expects($this->once())->method('supports')->with(7)->willReturn(true);
        $this->c->expects($this->once())->method('supports')->with(7)->willReturn(false);

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

    public function testSupplyDefersToTheCorrectFeed()
    {
        $this->a->expects($this->once())->method('supports')->with(4)->willReturn(true);
        $this->b->expects($this->once())->method('supports')->with(4)->willReturn(false);
        $this->c->expects($this->once())->method('supports')->with(4)->willReturn(false);
        $this->a->expects($this->once())->method('supply')->with(4)->willReturn([1, 2, 3, 4]);

        $this->assertEquals([1, 2, 3, 4], $this->feed->supply(4));
    }
}
