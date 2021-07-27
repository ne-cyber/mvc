<?php

class Loader {
    protected $registry;

    public function __construct($registry)
    {
        $this->registry = $registry;
    }

    public function model($route)
    {
        if(!$this->registry->has('model_' . str_replace('/', '_', $route)))
        {
            $file = DIR_APPLICATION . 'model/' . $route . '.php';
            $class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', $route);

            if(is_file($file))
            {
                include_once ($file);

                $proxy = new Proxy();

                foreach (get_class_methods($class) as $method)
                    $proxy->{$method} = $this->callback($this->registry, $route.'/'.$method);

                $this->registry->set('model_' . str_replace('/','_', $route), $proxy);
            }
            else
                throw new \Exception('Error: Could not load model ' . $route . '!');
        }
    }


    protected function callback($registry, $route)
    {
        return function ($args) use ($registry, $route)
        {
            static $model;

            $trigger = $route;

            //$result = $registry->get('event')->triger('model/' . $trigger . '/before', array(&$route, &$args));

            //if($result && !$result instanceof Exception)
            //{
            //    $output = $result;
            //}
            //else
            //{

            $class = 'Model' . substr($route, 0, strrpos($route, '/'));
            $key = substr($route, 0, strrpos($route, '/'));

            if(!isset($model[$key]))
            {
                $model[$key] = new $class($registry);
            }

            $method = substr($route, strrpos($route, '/') + 1);

            $callable = array($model[$key], $method);

            if(is_callable($callable))
                $output = call_user_func_array($callable, $args);
            else
                throw new \Exception('Error: Could not call model/' . $route . '!');

            //}

            return $output;
        };
    }
}