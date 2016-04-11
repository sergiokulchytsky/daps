<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 17-Mar-16
 * Time: 02:18
 */
include_once ROOT.'/application/models/Model_User.php'; ?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <link rel="stylesheet" href="/css/icon.css">
        <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="/js/timer.js"></script>
        <meta charset="UTF-8">
        <title>Lab</title>
    </head>
    <body>
        <div id="content">
            <header id="header">
                <div class="nav">
                    <ul class="pull-left">
                        <li><a href="/"><i class="material-icons">home</i>Home</a></li>
                        <li><a href="/about">About<i class="material-icons">info_outline</i></a></li>
                    </ul>
                    <ul class="pull-right">
                        <?php if(Model_User::isGuest()) {?>
                            <li><a href="/user/login">Login<i class="material-icons">lock_outline</i></a></li>
                        <?php } else { ?>
                            <li><a href="/profile"><i class="material-icons">account_circle</i>Profile</a></li>
                            <?php if(Model_User::isAdmin()):?>
                                <li><a href="/users/list"><i class="material-icons">people</i>Users</a></li>
                            <?php endif;?>
                            <li><a href="/user/logout">Logout<i class="material-icons">exit_to_app</i></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </header>

            <?=$content?>

        </div>
    </body>
</html>
