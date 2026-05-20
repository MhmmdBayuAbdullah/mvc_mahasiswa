<?php

class Router
{
    private $controller = 'HomeController';
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
        if (isset($url[0])) {

            $controllerName = ucfirst($url[0]) . 'Controller';

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

        $this->controller = new $this->controller;

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

        // jalankan controller
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