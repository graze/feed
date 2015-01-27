<?php

namespace Graze\Feed;

class RandomArticleFeed extends ArticleFeed
{
    /**
     * @return array
     */
    protected function getArticles()
    {
        shuffle($this->articles);
        return $this->articles;
    }
}
