<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 13-Mar-16
 * Time: 15:34
 */

    //include system files
    require_once(ROOT.'/application/core/Router.php');
    require_once(ROOT.'/application/core/Model.php');
    require_once(ROOT.'/application/core/View.php');
    require_once(ROOT.'/application/core/Controller.php');
    require_once(ROOT.'/application/core/DB.php');

    //router calling
    $router = new Router();
    $router->start();