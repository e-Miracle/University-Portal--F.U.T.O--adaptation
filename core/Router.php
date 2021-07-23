<?php


namespace core;


class Router
{
    public Request $request;
    protected array $routes =[];

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false){
            throw new \Exception("PAGE NOT FOUND", 404);
        }

        /*if (is_string($callback)) {
            return $this->render($callback);
        }*/

        if (is_array($callback)){
            $callback['controller'] = $this->getNamespace(). $callback['controller'];
            if (class_exists($callback['controller'])){
                Application::$app->controller = new $callback['controller']();
                $callback['controller'] = Application::$app->controller;
                if (is_callable([$callback['controller'], $callback['action']])){
                    $method =  $callback['action'];
                    return $callback['controller']->$method($this->request);
                }else{
                    throw new \Exception("$callback[action] is not a valid method in class $callback[controller]", 500);
                }
            }else{
                throw new \Exception("class $callback[controller] is not a valid class", 500);
            }
        }
        return call_user_func("\\".$callback);
    }

    private function getNamespace()
    {
        $namespace = 'app\controllers\\';
        $path = $this->request->path();
        $method = $this->request->method();

        $route = $this->routes[$method][$path];
        if (array_key_exists('namespace', $route)) {
            $namespace .= $route['namespace'] .'\\';
        }
        return $namespace;
    }

    public function render($view, $params = [])
    {
        $position = strpos($view, ".");
        if ($position){
            $view = str_replace(".", "/", $view);
        }

        if (is_readable(BASE_URL."/views/$view.php"))
        {
            $layoutContent = $this->layoutContent();
            $viewContent = $this->renderOnlyView($view, $params);
            if (array_key_exists('title', $params))
            {
                $layoutContent = str_replace('{{title}}', $params['title'], $layoutContent);
            }
            return str_replace('{{content}}', $viewContent, $layoutContent);
        }else{
            throw new \Exception("404 PAGE NOT FOUND", 404);
        }
    }

    public function renderDirect($view, $params = [])
    {
        $position = strpos($view, ".");
        if ($position){
            $view = str_replace(".", "/", $view);
        }
        if (is_readable(BASE_URL."/views/$view.php"))
        {
            return $this->renderOnlyView($view, $params);;
        }else{
            throw new \Exception("404 PAGE NOT FOUND", 404);
        }
    }

    private function layoutContent()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller) {
            $layout  = Application::$app->controller->layout;
        }

        $position = strpos($layout, ".");

        if ($position){
            $view = str_replace(".", "/", $layout);
        }

        ob_start();
        include_once BASE_URL."/views/layouts/$layout.php";
        return ob_get_clean();
    }

    private function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }

        $position = strpos($view, ".");
        if ($position){
            $view = str_replace(".", "/", $view);
        }

        if (is_readable(BASE_URL."/views/$view.php"))
        {
            ob_start();
            include_once BASE_URL."/views/$view.php";
            return ob_get_clean();
        }else{
            throw new \Exception("No such view as $view", 500);
        }
    }
}