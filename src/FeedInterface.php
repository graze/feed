<?php

namespace Graze\Feed;

interface FeedInterface
{
    /**
     * @param integer $number
     * @return boolean
     */
    public function supports($number);

    /**
     * @param integer $number
     * @return array
     */
    public function supply($number);
}
