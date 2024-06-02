<?php
class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if ($url === null) $url = [$this->controller];

        if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }else {
            $this->controller = 'ErrorController';
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;
        var_dump($this);
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
        }else if (!method_exists($this->controller, $this->method)){
            $this->controller = new ErrorController();
            $this->method = 'notFound';
        }
        unset($url[1]);
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {

            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return null;
    }
}
