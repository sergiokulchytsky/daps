<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 28-Feb-16
 * Time: 18:57
 */

    //base settings
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    session_start();

    //include bootstrap file
    define('ROOT', dirname(__FILE__));
    define('VIEW', dirname(__FILE__) . '/application/views/');
    require_once ROOT.'/application/bootstrap.php';





