<?php
/**
 * Include header and footer php files
 * php version 7
 *
 * @category PHP
 * @package  Core_Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */
 require_once APPROOT . '/views/inc/header.php'; 
?>

<h1><?php echo $data['title']; ?></h1>
<p><?php echo $data['description']; ?></p>
<p>Version: <strong><?php echo APPVERSION; ?></strong></p>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>