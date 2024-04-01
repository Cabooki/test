<?php

namespace Blog;

use Blog\Config;

class Favorites
{
    private array $ids;
    private array $categories;

    public function __construct($ids)
    {
        if (!empty($ids)) {
            $blog = new Blog;
            $allCategories = $blog->getCategories();
            foreach ($allCategories as $category) {
                $posts = $category->getPosts();
                foreach ($posts as $post) {
                    $postId = $post->getID();
                    if (in_array($postId, $ids)) {
                        $this->ids[] = $postId;
                    }
                }
            }
        }
        $this->categories = self::orderByCategories(Response::get());

        $this->sleepTime = rand(1, 5);
    }

    private function orderByCategories(array $posts): array
    {
        $categoriesOrder = [];

        foreach ($posts as $post) {
            $categoriesOrder[$post->userId][] = Post::create($post);
        }
        foreach ($categoriesOrder as $catId => $posts) {
            $category = Category::create($catId);
            foreach ($posts as $post) {
                if (!empty($this->ids) && in_array($post->getID(), $this->ids)) {
                    $category->addPost($post);
                }
            }

            if ($category->getCount()) {
                $this->categories[$catId] = $category;
            }
        }

        return $this->categories ?? [];
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getCountByCategory($catId): int
    {

        return !empty($this->categories[$catId]) ? $this->categories[$catId]->getCount() : 0;
    }

    public function getIds(): array
    {
        return $this->ids ?? [];
    }
}
