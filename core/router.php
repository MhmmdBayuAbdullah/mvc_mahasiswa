<?php

class Router
{
    private $controller = 'home_controller';
    private $method = 'index';
    private $params = [];

    public function parseURL()
    {
        if (isset($_GET['url'])) {

            $url = rtrim($_GET['url'], '/');

            $url = filter_var($url, FILTER_SANITIZE_URL);

            $url = explode('/', $url);

            return $url;
        }

        return [];
    }

    public function run()
    {
        $url = $this->parseURL();

        // controller
        if (isset($url[0]) && $url[0] != '') {

            $controllerName = strtolower($url[0]) . '_controller';

            if (file_exists("../app/controllers/$controllerName.php")) {

                $this->controller = $controllerName;

                unset($url[0]);

            } else {

                $this->error404();
                return;
            }
        }

        // require controller
        require_once "../app/controllers/" . $this->controller . ".php";

        // nama class controller
        $className = str_replace(
            ' ',
            '',
            ucwords(str_replace('_', ' ', $this->controller))
        );

        $this->controller = new $className;

        // method
        if (isset($url[1])) {

            if (method_exists($this->controller, $url[1])) {

                $this->method = $url[1];

                unset($url[1]);

            } else {

                $this->error404();
                return;
            }
        }

        // parameter
        $this->params = $url ? array_values($url) : [];

        // jalankan controller dan method
        call_user_func_array(
            [$this->controller, $this->method],
            $this->params
        );
    }

    public function error404()
    {
        echo "<h1>404 Not Found</h1>";
    }
}