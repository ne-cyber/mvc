<?php
class Action {
    public $route;
    public $method = 'index';

    public function __construct($route)
    {
        $parts = explode('/', $route);

        while($parts)
        {
            $file = DIR_APPLICATION . 'controller/' . implode('/', $parts) . '.php';

            if(is_file($file))
            {
                $this->route = implode('/', $parts);
                break;
            }
            else
            {
                $this->method = array_pop($parts);
            }
        }
    }

    public function execute($registry, array $args = array())
    {
        if(substr($this->method, 0, 2) == '__')
        {
            return new \Exception("Error: Calls to magic methods are not allowed!");
        }

        $file = DIR_APPLICATION . 'controller/' . $this->route . '.php';
        $class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $this->route);

        if(is_file($file))
        {
            include_once ($file);
            $controller = new $class($registry);
        }
        else
            return new \Exception('Error: Could not call ' . $this->route . '/' . $this->method . '!');

        $reflaction = new ReflectionClass($class);

        if($reflaction->hasMethod($this->method) && $reflaction->getMethod($this->method)->getNumberOfRequiredParameters() <= count($args))
            return call_user_func_array(array($controller, $this->method), $args);
        else
            return new \Exception('Error: Could not call ' . $this->route . '/' . $this->method . '!');
    }
}

?>