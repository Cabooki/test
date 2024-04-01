<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>403</title>
    <script src="./script.js"></script>
    <link rel="stylesheet" href="styles.css">
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

echo '<pre>$_SESSION - ';
print_r($_SESSION);
echo '</pre>';?>
<div id="posto" class="container">

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

