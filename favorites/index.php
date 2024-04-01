<?php
include_once(__DIR__ . '/../vendor/autoload.php');

session_start();

use Blog\Blog;
use Blog\Favorites;

$blog = new Favorites($_SESSION['FAVORITE_POSTS']);

if (!empty($_GET['addToFavorite'])) {
    if (empty($_SESSION['FAVORITE_POSTS']) || !in_array($_GET['addToFavorite'], $_SESSION['FAVORITE_POSTS']))
        $_SESSION['FAVORITE_POSTS'][] = $_GET['addToFavorite'];
    header("Location: /favorites/");
    die();
}

if (!empty($_GET['removeFromFavorite'])) {
    array_splice(
        $_SESSION['FAVORITE_POSTS'],
        array_search(
            $_GET['removeFromFavorite'],
            $_SESSION['FAVORITE_POSTS']),
        1
    );
    header("Location: /favorites/");
    die();
}

$categories = $blog->getCategories();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>403</title>
    <script src="./script.js"></script>
    <link rel="stylesheet" href="/../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="py-2 bg-body-tertiary border-bottom">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2 active"
                                    aria-current="page">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">About</a></li>
        </ul>
        <ul class="nav">
            <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">Login</a></li>
            <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">Sign up</a></li>
        </ul>
    </div>
</nav>
<header class="py-3 mb-4 border-bottom">
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">Double header</span>
        </a>
    </div>
</header>
<?php
session_start();

/*echo '<pre>$_SESSION - ';
print_r($_SESSION);
echo '</pre>';
echo '<pre>REQUEST_URI - ';
print_r($_SERVER['REQUEST_URI']);
echo '</pre>';*/
?>
<div class="container">
    <a class="main-link" href="/">Открыть все статьи</a>
</div>
<div class="container">
    <?php foreach ($categories as $category) { ?>
        <div id="category_<?php echo $category->getID(); ?>">
            <div>Всего статей в категории: <?= $category->getCount(); ?></div>
            <?php $posts = $category->getPosts();
            foreach ($posts as $post) {
                $buttonClass = 'addToFavoriteButton';
                $buttonMText = 'Добавить в избранное';
                $buttonAction = 'addToFavorite';
                if (true) {
                    $buttonClass = 'addToFavoriteButton remove';
                    $buttonMText = 'Удалить из избранного';
                    $buttonAction = 'removeFromFavorite';
                }?>
                <article>
                    <a class="<?php echo $buttonClass; ?>"
                       href="/favorites/?<?php echo $buttonAction . '=' .  $post->getID(); ?>">
                        <?php echo $buttonMText; ?>
                    </a>
                    <h2><?php echo $post->getTitle(); ?></h2>
                    <p><?php echo htmlspecialchars($post->getBody()); ?></p>
                    <hr>
                </article>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
        </ul>
        <p class="text-center text-body-secondary">© 2024 Company, Inc</p>
    </footer>
</div>
</body>
</html>
