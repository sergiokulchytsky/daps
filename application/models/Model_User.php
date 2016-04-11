<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 05-Mar-16
 * Time: 15:21
 */
    class Model_User extends Model {

        const MAGIC_NUMBER = 9;

        /**
         * Returns single user with specified id.
         * @param $userId
         * @return array
         */
        public static function getUserById($userId) {

            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $doc = [
                '_id' => new MongoId($userId)
            ];

            return $collection->findOne($doc);
        }

        /**
         * @return MongoCursor
         */
        public static function getUsersList() {

            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $doc = [
//                'admin' => false
            ];

            return $collection->find($doc);
        }

        /**
         * @param $name
         * @param $email
         * @param $verify
         * @return array|bool
         */
        public static function addUser($name, $email, $verify) {

            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $doc = [
                'name' => $name,
                'email' => $email,
                'pass' => '',
                'verify' => $verify,
                'blocked' => false,
                'admin' => false
            ];

            return $collection->insert($doc);
        }

        /**
         * @param $name
         * @param $email
         * @param $pass
         * @param bool $verify
         * @param bool $isBlocked
         * @param bool $isAdmin
         * @return bool
         */
        public static function registerUser($name, $email, $pass, $verify = false, $isBlocked = false, $isAdmin = false) {

            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $doc = [
                'name' => $name,
                'email' => $email,
                'pass' => self::cryptPass($pass),
                'verify' => $verify,
                'blocked' => $isBlocked,
                'admin' => $isAdmin
            ];

            return $collection->insert($doc);
        }

        /**
         * @param $name
         * @return bool
         */
        public static function checkFirstName($name) {
            if(strlen($name) >= 2) {
                return true;
            }
            return false;
        }

        /**
         * @param $password
         * @return bool
         */
        public static function checkPassword($password) {
            if(strlen($password) >= 3) {
                return true;
            }
            return false;
        }

        /**
         * @param $email
         * @return bool
         */
        public static function checkEmail($email) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            return false;
        }

        /**
         * @param $newPassword
         * @param $verPassword
         * @return bool
         */
        public static function checkPasswordsMatch($newPassword, $verPassword) {
            if($verPassword === $newPassword) {
                return true;
            }
            return false;
        }

        /**
         * @param $email
         * @return bool
         */
        public static function checkEmailExist($email) {

            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $doc = [
                'email' => $email
            ];

            $cursor = $collection->findOne($doc);

            if($cursor === null) {
                return true;
            }
            return false;
        }

        /**
         * @param $email
         * @param $password
         * @return bool
         */
        public static function checkUserData($email, $password) {

            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $doc = [
                'email' => $email,
                'pass' => self::cryptPass($password),
            ];

            $cursor = $collection->findOne($doc);

            if($cursor !== null) {
                return $cursor['_id']->{'$id'};
            }

            return false;
        }

        /**
         * @param $userId
         * @param $userPass
         * @return bool
         */
        public static function checkUserPassword($userId, $userPass) {

            $user = Model_User::getUserById($userId);

            if($user['pass'] === self::cryptPass($userPass)) {
                return true;
            }

            return false;
        }

        /**
         * @param $userId
         */
        public static function auth($userId) {
            session_start();
            $_SESSION['user'] = $userId;
            $_SESSION['timestamp'] = time();
        }

        /**
         * @param $userId
         * @param $userPass
         * @return bool
         */
        public static function changeUserPassword($userId, $userPass) {
            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $doc = [
                '_id' => new MongoId($userId)
            ];

            $pass = [
                '$set' => [
                    'pass' => self::cryptPass($userPass)
                ]
            ];

            return $collection->update($doc, $pass);
        }

        /**
         * @return mixed
         */
        public static function checkLoggedIn() {

            if(isset($_SESSION['user'])) {
                return $_SESSION['user'];
            }

            header('Location: /user/email');

            return true;
        }

        /**
         * @return bool
         */
        public static function isGuest() {
            if(isset($_SESSION['user'])) {
                return false;
            }
            return true;
        }

        /**
         * @return bool
         */
        public static function isAdmin() {
            if(isset($_SESSION['user'])) {
                $userId = $_SESSION['user'];

                $user = Model_User::getUserById($userId);

                if($user['admin']) {
                    return true;
                }
                return false;
            }
            return false;
        }

        /**
         * @param $userId
         * @param $blocked
         * @param $verify
         * @return bool
         */
        public static function updateUserSettings($userId, $blocked, $verify) {

            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $user = [
                '_id' => new MongoId($userId)
            ];

            $doc = [
                '$set' => [
                    'verify' => $verify,
                    'blocked' => $blocked
                ]
            ];

            return $collection->update($user, $doc);
        }

        /**
         * @param $userId
         * @return bool
         */
        public static function isBlocked($userId) {
            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $user = self::getUserById($userId);

            if($user['blocked']) {
                return true;
            }

            return false;
        }

        /**
         * @param $email
         * @return array|null
         */
        public static function getUserByEmail($email) {
            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $doc = [
                'email' => $email
            ];

            return $collection->findOne($doc);
        }

        /**
         * @param $password
         * @return bool
         */
        public static function checkSpecialPass($password) {
            if(preg_match('/([^\w.,!?:;()"\'\-\/]+)/u', $password) === 1) {
                return false;
            }
            return true;
        }

        /**
         * @param $password
         * @return bool
         */
        public static function checkNumPass($password) {
            if(preg_match('/([^0-9]+)/', $password) === 1) {
                return false;
            }
            return true;
        }

                /**
         * @param $password
         * @return float
         */
        private static function cryptPass($password) {

            $pass = log10(self::MAGIC_NUMBER/$password);

            return $pass;
        }

        public static function caesar($password) {

            $passArray = str_split($password);
            $key = 3;
            $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $length = count($alphabet);

            $result = "";

            foreach ($passArray as $letter) {
                if (in_array(ucfirst($letter),$alphabet)) {
                    $result .= $alphabet[(array_search(ucfirst($letter), $alphabet) + $key) % $length];
                } else {
                    $result .= $letter;
                }
            }

            return $result;
        }

        public static function blockUser($userId) {
            $db = DB::getConnection();
            $collection = $db->selectCollection('users');

            $doc = [
                '_id' => new MongoId($userId)
            ];

            $fields = [
                '$set' => [
                    'blocked' => true
                ]
            ];

            return $collection->update($doc,$fields);
        }
    }