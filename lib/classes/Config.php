<?php

namespace Blog;
class Config
{
    public static string $url = 'https://jsonplaceholder.typicode.com/posts/';
    public static array $favorites;

    public function __construct (array $ids)
    {
        if (empty($ids)) {
            self::$favorites = $_SESSION['FAVORITE_POSTS'];
        } else {
            self::$favorites = $ids;
        }
    }

    /**
     * @param string $url
     */
    public static function setUrl($url)
    {
        self::$url = $url;
    }
}
