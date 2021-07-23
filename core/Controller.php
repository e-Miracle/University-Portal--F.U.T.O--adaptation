<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core;


class Controller
{
    public string $layout = 'dashboard';
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    protected function view($view, $params = [])
    {
        return Application::$app->router->render($view, $params);
    }
    protected function viewDirect($view, $params = [])
    {
        return Application::$app->router->renderDirect($view, $params);
    }
}