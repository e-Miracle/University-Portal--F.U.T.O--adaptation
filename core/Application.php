<?php


namespace core;


class Application
{
    public Router $router;
    public Request $request;
    public string $layout = 'general';
    public string $title = '';
    public static Application $app;
    public ? Controller $controller = null;
    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request();
        $this->router = new Router($this->request);
    }
    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}