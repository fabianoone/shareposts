<?php

/**
 * Creates URL & loads Core Controllers
 * PHP version 7
 *
 * @category PHP
 * @package  Core_Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

/**
 * Core class in the application
 *
 * @category PHP
 * @package  Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */
class Core
{
    /**
     * Default Controller
     *
     * @var string
     */
    protected $currentController = 'Pages';
    /**
     * Default Method
     *
     * @var string
     */
    protected $currentMethod = 'index';

    /**
     * URL params
     *
     * @var array
     */
    protected $params = [];

    /**
     * Constructor method
     */
    public function __construct()
    {
        $url = $this->getUrl();

        // Look in controllers for first value
        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If exists, set as controller
                $this->currentController = ucwords($url[0]);
                // unset 0 Index
                unset($url[0]);
            }
        }

        // Require the controller
        include_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;

        // Check for second part of url
        if (isset($url[1])) {
            // Check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // unset Index 1
                unset($url[1]);
            }
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array(
            [$this->currentController, $this->currentMethod], 
            $this->params
        );
    }

    /**
     * Method getUrl
     * Sanitize the url
     *
     * @return void
     */
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
