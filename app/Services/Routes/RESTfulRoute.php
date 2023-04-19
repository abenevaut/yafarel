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

    public function __construct($path, $options)
    {
        if (is_string($options['method'])) {
            $this->method = strtolower($options['method']);
        }

        $this->route = new Rewrite($path, $options);
    }

    /**
     * @param Request_Abstract $request
     * @return bool
     */
    public function route($request): bool
    {
        if ($this->method !== '*') {
            $method = strtolower($request->getMethod());

            // POST, PUT od DELETE fallback method
            if (
                in_array($method, ['post', 'put', 'delete'])
                && isset($_POST['_method'])
            ) {
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
