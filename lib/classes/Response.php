<?php

namespace Blog;

class Response
{
    public static function get() : array
    {
        return json_decode(file_get_contents(Config::$url));
    }
}
