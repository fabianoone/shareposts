<?php

/**
 * Base Controller
 * PHP version 7
 *
 * @category PHP
 * @package  Controllers
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

/**
 * Controller class extended by others controllers
 *
 * @category PHP
 * @package  Controllers
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

class Controller
{
    /**
     * Model function
     *
     * @param [type] $model A string passed as param for the model name
     *
     * @return void
     */
    public function model($model)
    {
        // Require the model file
        include_once '../app/models/' . $model . '.php';

        // Instantiate the model
        return new $model;
    }

    /**
     * View function
     *
     * @param [type] $view A string passed as param to load the view
     * @param array  $data passed to view from the controllers
     *
     * @return void
     */
    public function view($view, $data = [])
    {
        // Check if file exists
        if (file_exists('../app/views/' . $view . '.php')) {
            include_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exists.');
        }
    }
}
