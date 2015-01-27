<?php

namespace Graze\Feed;

class RandomFeedStack extends FeedStack
{
    /**
     * @param integer $number
     * @return Product[]
     */
    public function supply($number)
    {
        shuffle($this->feeds);
        return parent::supply($number);
    }
}
