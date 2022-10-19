<?php
/** 
 * Simple redirect
 * PHP version 7
 *
 * @category PHP
 * @package  Helper
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

/**
 * Simple load redirect
 *
 * @param [type] $page 
 * 
 * @return void
 */
function redirect($page) 
{
    header('location: ' . URLROOT . '/' . $page);
}
