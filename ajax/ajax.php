<?php
class Config
{
    public static string $url = 'https://jsonplaceholder.typicode.com/posts/';

    public static function setUrl($url)
    {
        self::$url = $url;
    }
}

class Posts
{

    private static function response() : array
    {
        return json_decode(file_get_contents(Config::$url));
    }

    private function orderByCategories($allArticles): array
    {
        $categories = [];

        foreach ($allArticles as $post) {
            $categories[$post->userId][] = $post;
        }

        return $categories;
    }

    public function getAll(): array
    {
        return $this->orderByCategories(self::response());
    }
}

class FavoritePosts
{
    private array $favotitePosts;

    public function __construct()
    {
        if (!empty($_SESSION['FAVORITE_POSTS'])) {
            $this->favotitePosts = $_SESSION['FAVORITE_POSTS'];
        } else {
            $this->favotitePosts = [];
        }
    }

    public static function add($id): int
    {
        if (empty($_SESSION['FAVORITE_POSTS']) || !in_array($id, $_SESSION['FAVORITE_POSTS']))
            $_SESSION['FAVORITE_POSTS'][] = $id;

        return true;
    }

    public static function remove($id): bool
    {
        array_splice($_SESSION['FAVORITE_POSTS'],array_search($id, $_SESSION['FAVORITE_POSTS']), 1);

        return true;
    }

    public function getAll(): array
    {
        return $this->favotitePosts;
    }
}

session_start();

if (!empty($_REQUEST['addToFavorite'])) {
    exit (json_encode(FavoritePosts::add($_REQUEST['addToFavorite'])));
} elseif (!empty($_REQUEST['removeFromFavorite'])) {
    exit (json_encode(FavoritePosts::remove($_REQUEST['removeFromFavorite'])));
} elseif (!empty($_REQUEST['getFavorites']) && $_REQUEST['getFavorites'] === 'Y') {
    $favoritePosts = new FavoritePosts();

    exit (json_encode($favoritePosts->getAll()));
} else {
    $arPosts = new Posts();

    /*$sleepTime = rand(1, 5);*/

    //sleep($sleepTime);

    exit (json_encode($arPosts->getAll()));
}
