<?php

/**
 * Post Model
 * PHP version 7
 *
 * @category PHP
 * @package  Core_Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

/**
 * Post Class
 *
 * @category PHP
 * @package  Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */
class Post
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
     * Get Posts method
     *
     * @return void
     */
    public function getPosts()
    {
        $this->_db->query(
            "SELECT *,
                posts.id as postId,
                users.id as userId,
                posts.created_at as postCreated,
                users.created_at as userCreated
                FROM posts
                INNER JOIN users
                ON posts.user_id = users.id
                ORDER BY posts.created_at DESC"
        );
        $results = $this->_db->resultSet();
        return $results;
    }

    /**
     * Add new post
     *
     * @param [type] $data 
     *
     * @return void
     */
    public function addPost($data)
    {
        $this->_db->query('INSERT INTO posts (title, user_id, body) VALUES (:title, :user_id, :body)');
        // Bind values
        $this->_db->bind(':title', $data['title']);
        $this->_db->bind(':user_id', $data['user_id']);
        $this->_db->bind(':body', $data['body']);

        // Execute
        if ($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Update post
     *
     * @param [type] $data 
     *
     * @return void
     */
    public function updatePost($data)
    {
        $this->_db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
        $this->_db->bind(':id', $data['id']);
        $this->_db->bind(':title', $data['title']);
        $this->_db->bind(':body', $data['body']);

        // Execute
        if ($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get single post by id
     *
     * @param [type] $id 
     *
     * @return void
     */
    public function getPostById($id)
    {
        $this->_db->query('SELECT * FROM posts WHERE ID = :id');
        $this->_db->bind(':id', $id);
        $row = $this->_db->single();
        return $row;
    }

    /**
     * Delete a record from database
     *
     * @param [type] $id 
     *
     * @return void
     */
    public function deletePost($id)
    {
        $this->_db->query('DELETE FROM posts WHERE id = :id');
        // Bind values
        $this->_db->bind(':id', $id);

        // Execute
        if ($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
