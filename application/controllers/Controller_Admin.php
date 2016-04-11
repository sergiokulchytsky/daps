<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 19-Mar-16
 * Time: 19:05
 */
    include_once ROOT.'/application/models/Model_User.php';

    class Controller_Admin extends Controller {

        public $params = [];

        /**
         * Method that returns users list page
         */
        public function action_Index(){

            $userId = Model_User::checkLoggedIn();

            $isAdmin = Model_User::isAdmin();

            if(!$isAdmin) {
                $this->redirect('/');
            }

            $this->params['usersList'] = Model_User::getUsersList();

            $this->view->render('admin/index', $this->params);
        }

        /**
         * @param $userId
         * @return bool
         */
        public function action_Edit($userId){

            $admin = Model_User::checkLoggedIn();

            $isAdmin = Model_User::isAdmin();

            $this->params['result'] = false;

            if(!$isAdmin) {
                $this->redirect('/');
            }

            $this->params['user'] = Model_User::getUserById($userId);

            if(isset($_POST['submit'])) {
                $verify = isset($_POST['verify']) ? true : false ;
                $blocked = isset($_POST['blocked']) ? true : false ;

                $this->params['result'] = Model_User::updateUserSettings($userId, $blocked, $verify);
            }

            $this->view->render('admin/edit', $this->params);
        }

        public function action_Add() {

            $admin = Model_User::checkLoggedIn();

            $isAdmin = Model_User::isAdmin();

            $this->params['result'] = false;

            if(!$isAdmin) {
                $this->redirect('/');
            }

            $this->params['name'] = '';
            $this->params['email'] = '';

            if(isset($_POST['submit'])) {
                $this->params['name'] = $_POST['name'];
                $this->params['email'] = $_POST['email'];
                $verify = isset($_POST['verify']) ? true : false;

                $this->params['errors'] = false;

                if(!Model_User::checkFirstName($this->params['name'])) {
                    $this->params['errors']['name'] = 'Invalid Name!';
                }

                if(!Model_User::checkEmail($this->params['email'])) {
                    $this->params['errors']['email'] = 'Invalid Email!';
                } elseif(!Model_User::checkEmailExist($this->params['email'])) {
                    $this->params['errors']['email'] = 'User with This email already exist!';
                }

                if($this->params['errors'] === false) {
                    $this->params['result'] = Model_User::addUser($this->params['name'], $this->params['email'], $verify);
                }

            }

            $this->view->render('admin/add', $this->params);
        }
    }