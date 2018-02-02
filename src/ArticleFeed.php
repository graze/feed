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

class ArticleFeed extends AbstractFeed
{
    /**
     * @var array
     */
    protected $articles = [];

    /**
     * Array of articles
     *
     * @param array $articles
     */
    public function __construct(array $articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return array
     */
    protected function getArticles()
    {
        return $this->articles;
    }
}
