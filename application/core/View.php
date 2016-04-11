<?php
/**
 * Created by PhpStorm.
 * User: serhi
 * Date: 28-Feb-16
 * Time: 19:06
 */
    class View {

        private function fetchPartial($template, $params = []) {
            extract($params);
            ob_start();
            include VIEW.$template.'.php';
            return ob_get_clean();
        }

        public function renderPartial($template, $params = []) {
            echo $this->fetchPartial($template, $params);
        }

        public function fetch($template, $params = []) {
            $content = $this->fetchPartial($template, $params);
            return $this->fetchPartial('layouts/header', ['content' => $content]);
        }

        public function render($template, $params = []) {
            echo $this->fetch($template, $params);
        }

    }