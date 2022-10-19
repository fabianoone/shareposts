<?php

/**
 * Bootstrap
 * php version 7.4^
 *
 * @category Bootstrap_File
 * @package  Require
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @version  GIT: @1.0.0@
 * @link     https://github.com/fabianoone
 */

/**
 * Load Config 
 **/
require_once 'config/config.php';
/**
 * Load Helpers
 */
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

// Load Libraries
spl_autoload_register(
    function ($className) {
        include_once 'libraries/' . $className . '.php';
    }
);
