<?php

/**
 * PDO Database Class
 * PHP version 7
 *
 * @category PHP
 * @package  Core_Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

/**
 * Core Database class in the application
 * Create prepared statements
 * Bind values
 * Return row and results
 *
 * @category PHP
 * @package  Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

class Database
{
    /**
     * Use database host defined in config file
     *
     * @var [type]
     */
    private $_host = DB_HOST;
    /**
     * Use database user defined in config file
     *
     * @var [type]
     */
    private $_user = DB_USER;
    /**
     * Use database password defined in config file
     *
     * @var [type]
     */
    private $_pass = DB_PASS;
    /**
     * Use database name defined in config file
     *
     * @var [type]
     */
    private $_dbname = DB_NAME;

    private $_dbh;
    private $_stmt;
    private $_error;

    /**
     * Constructor method
     */
    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->_host . ';dbname=' . $this->_dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->_dbh = new PDO($dsn, $this->_user, $this->_pass, $options);
        } catch (PDOException $e) {
            $this->_error = $e->getMessage();
            echo $this->_error;
        }
    }

    /**
     * Query method
     * Prepare statement with query
     *
     * @param [type] $sql Query statement
     * 
     * @return void
     */
    public function query($sql)
    {
        $this->_stmt = $this->_dbh->prepare($sql);
    }

    /**
     * Bind method
     *
     * @param [type] $param the param variable to bind
     * @param [type] $value type of the params [int, bool, null, str]
     * @param [type] $type  variable to be checked
     *
     * @return void
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch ($value) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
            }
        }
        $this->_stmt->bindValue($param, $value, $type);
    }

    /**
     * Execute the prepared statement
     *
     * @return void
     */
    public function execute()
    {
        return $this->_stmt->execute();
    }

    /**
     * Get result set as array of objects
     *
     * @return void
     */
    public function resultSet()
    {
        $this->execute();
        return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get single record as object
     *
     * @return void
     */
    public function single()
    {
        $this->execute();
        return $this->_stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get row count
     *
     * @return void
     */
    public function rowCount()
    {
        return $this->_stmt->rowCount();
    }
}
