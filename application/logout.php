<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 30-Mar-16
 * Time: 00:18
 */
unset($_SESSION['timestamp']);
unset($_SESSION['user']);
header('Location: /user/logout');