<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 05-Mar-16
 * Time: 15:19
 */
include_once ROOT . '/application/models/Model_User.php';

class Controller_User extends Controller
{

    const TIME = 15;

    public $params = [];

    public function action_Index()
    {
        return true;
    }

    public function action_Setpassword($userId)
    {

        if (!Model_User::isGuest()) {
            $this->redirect('/');
        }

        $this->params['newPassword'] = '';
        $this->params['verPassword'] = '';

        $this->params['result'] = false;
        $this->params['errors'] = false;

        if (isset($_POST['submit'])) {

            $this->params['newPassword'] = $_POST['new_pass'];
            $this->params['verPassword'] = $_POST['ver_pass'];

            $this->params['user'] = Model_User::getUserById($userId);

            if (!Model_User::checkPassword($this->params['newPassword']) || !Model_User::checkNumPass($this->params['newPassword'])) {
                $this->params['errors']['new_pass'] = 'Password must contains only digits 0-9!';
            }

            if (!Model_User::checkPassword($this->params['verPassword']) || !Model_User::checkNumPass($this->params['verPassword'])) {
                $this->params['errors']['ver_pass'] = 'Password must contains only digits 0-9!';
            }

//                if(!Model_User::checkPassword($this->params['newPassword'])) {
//                    $this->params['errors']['new_pass'] = 'Invalid Password!';
//                } elseif($this->params['user']['verify']) {
//                    if(!Model_User::checkSpecialPass($this->params['newPassword'])) {
//                        $this->params['errors']['new_pass'] = 'Password must contains А-Я, A-Z and special characters!';
//                    }
//                }

//                if(!Model_User::checkPassword($this->params['verPassword'])) {
//                    $this->params['errors']['ver_pass'] = 'Invalid Verify Password!';
//                } elseif($this->params['user']['verify']) {
//                    if(!Model_User::checkSpecialPass($this->params['verPassword'])) {
//                        $this->params['errors']['ver_pass'] = 'Password must contains А-Я, A-Z and special characters!';
//                    }
//                }

            if (Model_User::checkPassword($this->params['newPassword']) && Model_User::checkPassword($this->params['verPassword']) &&
                !Model_User::checkPasswordsMatch($this->params['newPassword'], $this->params['verPassword'])
            ) {
                $this->params['errors']['match'] = 'Passwords does\'t match!';
            }

            if ($this->params['errors'] === false) {
                $this->params['result'] = Model_User::changeUserPassword($userId, $this->params['newPassword']);

                if ($this->params['result']) {
                    Model_User::auth($userId);
                    $this->redirect('/profile/');
                }
            } else {
                isset($_COOKIE['fails']) ? setcookie('fails', ++$_COOKIE['fails'], null, '/') : setcookie('fails', 1, null, '/');
            }
            setcookie('fails', 0, null, '/');
        }

        $this->view->render('users/setpass_view', $this->params);

        return true;
    }

    public function action_Enter($userId)
    {

        if (!Model_User::isGuest()) {
            $this->redirect('/');
        }

        $this->params['password'] = '';
        $this->params['userId'] = $userId;

        if (isset($_POST['submit'])) {

            $this->params['user'] = Model_User::getUserById($userId);

            $this->params['email'] = $this->params['user']['email'];
            $this->params['password'] = $_POST['password'];

            $this->params['errors'] = false;

            if (!Model_User::checkPassword($this->params['password']) || !Model_User::checkNumPass($this->params['password'])) {
                $this->params['errors']['password'] = 'Password must contains only digits 0-9!';
            }

//                if(!Model_User::checkPassword($this->params['password'])) {
//                    $this->params['errors']['password'] = 'Invalid Password!';
//                } elseif($this->params['user']['verify']) {
//                    if(!Model_User::checkSpecialPass($this->params['password'])) {
//                        $this->params['errors']['password'] = 'Password must contains А-Я, A-Z and special characters!';
//                    }
//                }

            if ($this->params['errors'] === false) {
                $newUserId = Model_User::checkUserData($this->params['email'], $this->params['password']);

                if ($newUserId === false) {
                    $this->params['errors']['login'] = 'Please enter a valid password!';
//                    var_dump(unserialize($_COOKIE[$userId]));
                    if (isset($_COOKIE[$userId])) {
                        if (unserialize($_COOKIE[$userId])['count'] == 9) {
                            Model_User::blockUser($userId);
                            $this->params['errors']['time'] = '10 attempts used! User is blocked!';
                        }
                        if (unserialize($_COOKIE[$userId])['fails'] == 1) {
                            $fields = unserialize($_COOKIE[$userId]);
                            $fields['fails'] = 0;
                            $fields['count']++;
                            $fields['blocked'] = true;
                            $fields['time'] = time();
                            setcookie($userId, serialize($fields), null, '/');
                            $time = self::TIME - (time() - $fields['time']);
                            $this->params['errors']['time'] = 'Try after ' . $time . ' seconds!';
//                            $this->redirect('/user/email');
                        } else {
                            $fields = unserialize($_COOKIE[$userId]);
                            $fields['fails']++;
                            setcookie($userId, serialize($fields), null, '/');
                        }

                    } else {
                        $fields = [
                            'fails' => 1,
                            'count' => 0,
                            'blocked' => false,
                            'time' => 0
                        ];
                        setcookie($userId, serialize($fields), null, '/');
                    }
                } else {
                    Model_User::auth($userId);
                    $this->redirect('/profile/');
                }
            }
        }

        $this->view->render('users/enterpass_view', $this->params);

        return true;
    }

    public function action_Login()
    {

        if (!Model_User::isGuest()) {
            $this->redirect('/');
        }

        $this->params['email'] = '';
        $this->params['password'] = '';

        if (isset($_POST['submit'])) {
            $this->params['email'] = $_POST['email'];
            $this->params['password'] = $_POST['password'];

            Model_User::caesar($this->params['password']);
            
            $this->params['errors'] = false;
            $this->params['result'] = false;

            if (!Model_User::checkEmail($this->params['email'])) {
                $this->params['errors']['email'] = 'Invalid Email!';
            }

            if (!Model_User::checkPassword($this->params['password']) || !Model_User::checkNumPass($this->params['password'])) {
                $this->params['errors']['password'] = 'Password must contains only digits 0-9!';
            }

//                if(!Model_User::checkPassword($this->params['password'])) {
//                    $this->params['errors']['password'] = 'Invalid Password!';
//                }

            if ($this->params['errors'] === false) {
                $userId = Model_User::checkUserData($this->params['email'], $this->params['password']);

                $blocked = Model_User::isBlocked($userId);

                if ($userId === false) {
                    $this->params['errors']['login'] = 'Please enter a valid email and password!';
                    isset($_COOKIE['fails']) ? setcookie('fails', ++$_COOKIE['fails'], null, '/') : setcookie('fails', 1, null, '/');
                } elseif ($blocked) {
                    $this->params['errors']['login'] = 'This user is Blocked!';
                } else {
                    setcookie('fails', 0, null, '/');
                    Model_User::auth($userId);
                    $this->redirect('/profile/');
                }
            }
        }

        $this->view->render('users/signin_view', $this->params);

        return true;
    }

    public function action_Logout()
    {
        session_start();
        unset($_SESSION['user']);
        unset($_SESSION['timestamp']);
        $this->redirect('user/email');
    }

    /**
     * @return bool
     */
    public function action_Register()
    {

        if (!Model_User::isGuest()) {
            $this->redirect('/');
        }

        $this->params['name'] = '';
        $this->params['email'] = '';
        $this->params['password'] = '';

        $this->params['result'] = false;

        if (isset($_POST['submit'])) {
            $this->params['name'] = $_POST['name'];
            $this->params['email'] = $_POST['email'];
            $this->params['password'] = $_POST['password'];

            $this->params['errors'] = false;

            if (!Model_User::checkFirstName($this->params['name'])) {
                $this->params['errors']['name'] = 'Invalid Name!';
            }

            if (!Model_User::checkEmail($this->params['email'])) {
                $this->params['errors']['email'] = 'Invalid Email!';
            } elseif (!Model_User::checkEmailExist($this->params['email'])) {
                $this->params['errors']['email'] = 'User with This email already exist!';
            }

            if (!Model_User::checkPassword($this->params['password']) || !Model_User::checkNumPass($this->params['password'])) {
                $this->params['errors']['password'] = 'Password must contains only digits 0-9!';
            }

//                if(!Model_User::checkPassword($this->params['password'])) {
//                    $this->params['errors']['password'] = 'Invalid Password!';
//                }

            if ($this->params['errors'] === false) {
                $this->params['result'] = Model_User::registerUser($this->params['name'], $this->params['email'], $this->params['password']);

                if ($this->params['result']) {
                    $userId = Model_User::checkUserData($this->params['email'], $this->params['password']);
                    Model_User::auth($userId);
                    $this->redirect('/profile/');
                }
            }
        }

        $this->view->render('users/signup_view', $this->params);

        return true;
    }
}