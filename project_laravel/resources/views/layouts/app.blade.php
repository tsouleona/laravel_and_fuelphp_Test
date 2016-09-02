<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 8/31/16
 * Time: 9:13 PM
 */
// resources/views/layouts/app.blade.php
?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel 快速入門 - 基本</title>

    <!-- CSS 及 JavaScript -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="container">
    <nav class="navbar navbar-default">
        <!-- Navbar 內容 -->
    </nav>
</div>

@yield('content')
</body>
</html>