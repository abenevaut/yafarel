<?php

namespace App\Services\Routes;

use Yaf\Route\Regex;
use Yaf\Route\Rewrite;
use Yaf\Route_Interface;
use Yaf\Request_Abstract;

/**
 * RESTful Route
 *
 * credits to https://github.com/rhyzx/yaf-restful
 */
final class RESTfulRoute implements Route_Interface
{
    private $route;

    // default any method
    private $method = '*';

    public function __construct($path, $options, $strict)
    {
        if (is_string($options['method'])) {
            $this->method = strtolower($options['method']);
        }

        // default base on rewrite route
        if (!$strict) {
            $this->route = new Rewrite($path, $options);
        }
        // strict style route syntax base on regex route
        // eg. '/user/<name>', match '/user/haha', not match '/user/haha/', not match 'user/haha'
        // type filter extended
        // eg. '/user/<id:int>', match '/user/123', not match '/user/haha'
        // some regex is also supported, don't use "()"
        // eg. '/user/<name>/?', match '/user/haha' and match '/user/haha/'
        else {
            $keys = []; // must start with 1, YAF sucks
            $path = preg_replace_callback(
                '/<(\w+)(:int)?>/',
                function ($matches) use (&$keys) {
                    array_push($keys, $matches[1]);

                    $regex = '([\w-%]+)'; // normal type
                    if (isset($matches[2])) { // integer type, TODO other types
                        $regex = '(\d+)';
                    }

                    return $regex;
                },
                $path
            );

            unset($keys[0]);
            // regex must wrapped by #
            $this->route = new Regex("#^$path$#", $options, $keys);
        }
    }

    /**
     * @param Request_Abstract $request
     * @return bool
     */
    public function route($request): bool
    {
        // HTTP method adapt
        if ($this->method !== '*') {
            $method = strtolower($request->getMethod());

            // POST fallback method
            if ($method === 'post' && isset($_POST['_method'])) {
                $method = strtolower($_POST['_method']);
            }
            // PUT fallback method
            else if ($method === 'put' && isset($_POST['_method'])) {
                $method = strtolower($_POST['_method']);
            }
            // DELETE fallback method
            else if ($method === 'delete' && isset($_POST['_method'])) {
                $method = strtolower($_POST['_method']);
            }

            if ($method !== $this->method) {
                return false;
            }
        }

        return $this->route->route($request);
    }

    public function assemble(array $mvc, array $query = NULL)
    {
        // interface method
    }
}
