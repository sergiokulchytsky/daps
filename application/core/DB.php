<?php

/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 15-Mar-16
 * Time: 01:19
 */
    class DB
    {
        public static function getConnection() {

            $paramsPath = ROOT.'/application/config/db_params.php';
            $params = include($paramsPath);

            $connection = new MongoClient();
            $db = $connection->selectDB($params['db']);
            return $db;
        }
    }