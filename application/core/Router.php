<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 28-Feb-16
 * Time: 19:07
 */
    class Router {

        private $routes;

        /**
         * Router constructor.
         */
        public function __construct()
        {
            $routesPath = ROOT.'/application/config/routes.php';
            $this->routes = include($routesPath);
        }

        /**
         * Returns array from REQUEST URI.
         * @return array
         */
        private function getURI() {
            if(!empty($_SERVER['REQUEST_URI'])) {
                return trim($_SERVER['REQUEST_URI'], '/');
            }
        }

        /**
         * Start router.
         */
        public function start() {

            //get request
            $uri = $this->getURI();

            //check request exist in routes.php
            foreach ($this->routes as $uriPattern => $path) {
                if(preg_match("~$uriPattern~", $uri)) {
                    //define controller, action, params
                    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                    $segments = explode("/", $internalRoute);

                    $controllerName = 'Controller_'.ucfirst(array_shift($segments));
                    $actionName = 'action_'.ucfirst(array_shift($segments));


                    //connect controller file if exist
                    $controllerFile = ROOT.'/application/controllers/'.$controllerName.'.php';

                    if(file_exists($controllerFile)) {
                        include_once($controllerFile);
                    }

                    if(!is_callable($controllerName, $actionName)) {
                        Router::ErrorPage404();
                    }

                    //create object, call action
                    $controllerObject = new $controllerName();
                    $objectAction = call_user_func_array(array($controllerObject, $actionName),$segments);

                    if($objectAction !== null) {
                        break;
                    }
                }
            }


        }

        /**
         * Returns 404 Error page.
         */
        static function ErrorPage404() {
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('HTTP/1.1 404 Not Found');
            header('Status: 404 Not Found');
            header('Location:'.$host.'404');
            return;
        }
    }