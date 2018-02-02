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

abstract class AbstractFeed implements FeedInterface
{
    /**
     * @param int $number
     * @return bool
     */
    public function supports($number)
    {
        return (count($this->getArticles()) >= (int)$number)
            && ((int)$number >= 0);
    }

    /**
     * @param int $number
     * @throws LogicException
     * @return array
     */
    public function supply($number)
    {
        if (!$this->supports($number)) {
            throw new LogicException("cannot supply $number articles - not supported");
        }

        $articles = $this->getArticles();
        return array_slice($articles, 0, $number);
    }

    /**
     * @return array
     */
    abstract protected function getArticles();
}
