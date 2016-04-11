<?php

/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 16-Mar-16
 * Time: 01:45
 */
    include_once ROOT.'/application/models/Model_User.php';

    class Controller_Profile extends Controller {

        public $params = [];

        public function action_Index() {

            $userId = Model_User::checkLoggedIn();

            $this->params['user'] = Model_User::getUserById($userId);

            $this->view->render('profile/index', $this->params);
            
            return true;
        }

        /**
         * @return bool
         */
        public function action_Edit() {

            $userId = Model_User::checkLoggedIn();

            $this->params['oldPassword'] = '';
            $this->params['newPassword'] = '';
            $this->params['verPassword'] = '';

            $this->params['result'] = false;

            if(isset($_POST['submit'])) {

                $user = Model_User::getUserById($userId);

                $this->params['oldPassword'] = $_POST['old_pass'];
                $this->params['newPassword'] = $_POST['new_pass'];
                $this->params['verPassword'] = $_POST['ver_pass'];

                $this->params['errors'] = false;

                if (!Model_User::checkPassword($this->params['oldPassword']) || !Model_User::checkNumPass($this->params['oldPassword'])) {
                    $this->params['errors']['old_pass'] = 'Password must contains only digits 0-9!';
                }

                if (!Model_User::checkPassword($this->params['newPassword']) || !Model_User::checkNumPass($this->params['newPassword'])) {
                    $this->params['errors']['new_pass'] = 'Password must contains only digits 0-9!';
                }

                if (!Model_User::checkPassword($this->params['verPassword']) || !Model_User::checkNumPass($this->params['verPassword'])) {
                    $this->params['errors']['ver_pass'] = 'Password must contains only digits 0-9!';
                }
                
//                if(!Model_User::checkPassword($this->params['oldPassword'])) {
//                    $this->params['errors']['old_pass'] = 'Invalid Old Password!';
//                } elseif(!Model_User::checkUserPassword($userId, $this->params['oldPassword'])) {
//                    $this->params['errors']['old_pass'] = 'Invalid Old Password!';
//                }
//
//                if(!Model_User::checkPassword($this->params['newPassword'])) {
//                    $this->params['errors']['new_pass'] = 'Invalid New Password!';
//                } elseif($user['verify']) {
//                    if(!Model_User::checkSpecialPass($this->params['newPassword'])) {
//                        $this->params['errors']['new_pass'] = 'Password must contains А-Я, A-Z and special characters!';
//                    }
//                }
//
//                if(!Model_User::checkPassword($this->params['verPassword'])) {
//                    $this->params['errors']['ver_pass'] = 'Invalid Verify Password!';
//                } elseif($user['verify']) {
//                    if(!Model_User::checkSpecialPass($this->params['newPassword'])) {
//                        $this->params['errors']['ver_pass'] = 'Password must contains А-Я, A-Z and special characters!';
//                    }
//                }

                if(Model_User::checkPassword($this->params['newPassword']) && Model_User::checkPassword($this->params['verPassword']) &&
                    !Model_User::checkPasswordsMatch($this->params['newPassword'], $this->params['verPassword'])) {
                    $this->params['errors']['match'] = 'Passwords does\'t match!';
                }

                if($this->params['errors'] === false) {
                    $this->params['result'] = Model_User::changeUserPassword($userId, $this->params['newPassword']);
                }

            }

            $this->view->render('profile/edit', $this->params);
            
            return true;
        }
        
    }