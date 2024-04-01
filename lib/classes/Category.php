<?php

namespace Blog;

class Category
{
    private int $id;
    private array $posts;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public static function create(int $id): Category
    {
        return new Category($id);
    }

    public function addPost(Post $post): bool
    {
        $this->posts[] = $post;
        return true;
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function get(): Category
    {
        return $this;
    }

    public function getPosts(): array
    {
        return $this->posts;
    }

    public function getCount(): int
    {
        return !empty($this->posts) ? count($this->posts) : false;
    }
}
