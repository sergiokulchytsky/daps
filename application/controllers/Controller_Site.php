<?php

/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 18-Mar-16
 * Time: 00:53
 */
class Controller_Site extends Controller {

    public function action_Index() {

        $this->view->render('site/index', []);

    }

    public function action_About() {

        $this->view->render('site/about', []);

    }

}