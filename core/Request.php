<?php


namespace core;


use core\middlewares\Session;

class Request
{

    public function path()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, "?");

        //remove the last slash always added after the url
        if (substr_count($path, '/') > 1)
        {
            if (substr($path, -1) == '/' && !$position)
            {
                $path = substr($path, 0, -1);
            }
        }

        if ($position === false){
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function data()
    {
        $data = new \stdClass();
        $i=0;
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $data->$key = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);

                if ($i == 0) {
                    $v = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    Session::set(NAVIGATION, '?'.$key.'='.$v);
                }else{
                    $v = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    $get = Session::get(NAVIGATION).'&'.$key.'='.$v;
                    Session::set(NAVIGATION, $get);
                }

                $i++;
            }
        }
        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $data->$key = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $data;
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function validate(array $rules)
    {
        //typecasting the $data to convert to array
        $data = (array)$this->data();
        $error = false;

        foreach ($rules as $key => $values)
        {
            $values = explode('|', $values);
            foreach ($values as $value)
            {
                if ($value === 'required')
                {
                    if (!array_key_exists($key, $data) || $data[$key] == '')
                    {
                        $error[$key] = $this->__errorMessages()[$value];
                    }
                }

                //block to check for the '=' sign in value
                if (substr($value, 0, 3) == 'min' || substr($value, 0, 3) == 'max')
                {
                    $value = explode('=', $value);
                    if ($value[0] == 'min' && $value[1] > strlen($data[$key]))
                    {
                        $error[$key] = $this->__errorMessages()[$value[0]];
                    }
                    if ($value[0] == 'max' && $value[1] < strlen($data[$key]))
                    {
                        $error[$key] = $this->__errorMessages()[$value[0]];
                    }
                }
            }
        }
        return $error ? $error : true;
    }

    private function __errorMessages(): array
    {
        return [
            'required'=>'This field is required',
            'unique'=>'oops! already in use by another user',
            'min'=>'min length must be',
            'max'=>'max length must be',
        ];
    }
}