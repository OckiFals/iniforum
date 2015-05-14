<?php
/**
 * Router using regex match
 * @author Ocki Bagus Pratama
 * @package Ngaji/Routing
 * @since 2.0.1
 */
namespace Ngaji\Routing;


class Router2 {
    protected $config;
    protected $route = [];

    public function __construct($config = []) {
        $this->config = $config;
    }

    public function setRoute($method, $route, $target, $name = null) {
        $this->route[] = [$method, $route, $target, $name];
    }

    public function getRoute($route) {
        return $this->route["$route"];
    }

    public function match() {
        $urlRequest = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

        if (in_array($urlRequest, $this->route[1])) {

        }

        preg_match('/(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2})/', $urlRequest);

        var_dump($urlRequest);
    }
}