<?php

/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 28-Feb-16
 * Time: 19:06
 */
class Controller {
    private $model;
    protected $view;

    function __construct() {
        $this->view = new View();
    }

    public function action_Index() {
    }

    public function redirect($url) {
        header('Location: ' . $url);
    }
}