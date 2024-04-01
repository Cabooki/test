<?php

namespace Blog;
class Post
{
    private int $id;
    private int $userId;
    private string $title;
    private string $body;

    /**
     * @param object $post
     */
    public function __construct(object $post)
    {
        $this->id = $post->id;
        $this->userId = $post->userId;
        $this->title = $post->title;
        $this->body = $post->body;
    }

    /**
     * @return int
     */
    public function getID () : int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserID () : int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getTitle () : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody () : string
    {
        return $this->body;
    }

    /**
     * @param object $post
     * @return Post
     */
    public static function create(object $post): Post
    {
        return new Post($post);
    }
}
