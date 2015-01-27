<?php

namespace Graze\Feed;

use LogicException;

abstract class AbstractFeed implements FeedInterface
{
    /**
     * @param integer $number
     * @return boolean
     */
    public function supports($number)
    {
        return (count($this->getArticles()) >= (int) $number)
                && ((int) $number >= 0);
    }

    /**
     * @param integer $number
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
