<?php

/**
 * User Model
 * PHP version 7
 *
 * @category PHP
 * @package  Core_Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

/**
 * User Class
 *
 * @category PHP
 * @package  Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */
class User
{
    /**
     * Database private variable
     *
     * @var [type]
     */
    private $_db;

    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->_db = new Database; 
    }

    /**
     * Register user method
     *
     * @param [type] $data 
     * 
     * @return void
     */
    public function register($data)
    {
        $this->_db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        // Bind values
        $this->_db->bind(':name', $data['name']);
        $this->_db->bind(':email', $data['email']);
        $this->_db->bind(':password', $data['password']);

        // Execute
        if ($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Login user method
     *
     * @param [type] $email 
     * @param [type] $password 
     *
     * @return void
     */
    public function login($email, $password)
    {
        $this->_db->query('SELECT * FROM users WHERE email = :email');
        $this->_db->bind(':email', $email);

        $row = $this->_db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    /**
     * Find user by email method
     *
     * @param [type] $email 
     * 
     * @return void
     */
    public function findUserByEmail($email)
    {
        $this->_db->query('SELECT * FROM users WHERE email = :email');
        // Bind value
        $this->_db->bind(':email', $email);

        $row = $this->_db->single();

        // Check row
        if ($this->_db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get user by id
     *
     * @param [type] $id 
     *
     * @return void
     */
    public function getUserById($id)
    {
        $this->_db->query('SELECT * FROM users WHERE id = :id');
        // Bind value
        $this->_db->bind(':id', $id);

        $row = $this->_db->single();
        return $row;
    }
}
