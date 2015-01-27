<?php

namespace Graze\Feed;

class ArticleFeed extends AbstractFeed
{
    /**
     * @var array
     */
    protected $articles = [];


    /**
     * @param array
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
