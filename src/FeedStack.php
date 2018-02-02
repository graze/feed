<?php

/**
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

class FeedStack implements FeedInterface
{
    /**
     * @var Graze\Web\Feed\FeedInterface[]
     */
    protected $feeds = [];

    /**
     * FeedStack constructor.
     *
     * @param array $feeds
     */
    public function __construct(array $feeds)
    {
        foreach ($feeds as $feed) {
            $this->addFeed($feed);
        }
    }

    /**
     * @param int $number
     * @return bool
     */
    public function supports($number)
    {
        return (bool)array_filter(array_map(function (FeedInterface $feed) use ($number) {
            return $feed->supports($number);
        }, $this->feeds));
    }

    /**
     * @param int $number
     * @return Product[]
     */
    public function supply($number)
    {
        foreach ($this->feeds as $feed) {
            if ($feed->supports($number)) {
                return $feed->supply($number);
            }
        }
        throw new LogicException("no supporting feed exists for $number products");
    }

    /**
     * @param FeedInterface $feed
     * @return $this
     */
    protected function addFeed(FeedInterface $feed)
    {
        array_unshift($this->feeds, $feed);
        return $this;
    }
}
