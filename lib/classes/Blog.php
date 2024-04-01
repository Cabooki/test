<?php

namespace Blog;

class Blog
{
    private array $categories;
    private int $sleepTime;

    public function __construct()
    {
        $this->categories = self::orderByCategories(Response::get());
        $this->sleepTime = rand(1, 5);
    }

    private function orderByCategories (array $posts): array
    {
        $categoriesOrder = [];

        foreach ($posts as $post) {
            $categoriesOrder[$post->userId][] = Post::create($post);
        }

        foreach ($categoriesOrder as $catId => $posts) {
            $category = Category::create($catId);
            foreach ($posts as $post) {
                $category->addPost($post);
            }
            $this->categories[] = $category;
        }

        return $this->categories;
    }

    public function addCategory(Category $category)
    {
        $this->categories[] = $category;
    }

    public function getCategories(): array
    {
        sleep($this->sleepTime);
        return $this->categories;
    }

    public function get(): Blog
    {
        return $this;
    }
}
