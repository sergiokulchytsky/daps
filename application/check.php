<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 30-Mar-16
 * Time: 00:27
 */
session_start();
$action = $_GET['action'];
$time = 30000;
if($action=='checktime') {
    if(isset($_SESSION['timestamp']) ) {
        $session_life = time() - $_SESSION['timestamp'];
        echo ($session_life > $time) ? "0" : "1";
    }
}
