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
require_once APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light">
    <i class="fa fa-arrow-left"></i> Back
</a>
<br>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?php echo $data['user']->name; ?> on
    <?php
        $date = new DateTimeImmutable($data['post']->created_at);
        echo date('d/m/Y H:i:s', $date->getTimestamp());
    ?>
</div>
<p><?php echo $data['post']->body; ?></p>

<?php if ($data['post']->user_id === $_SESSION['user_id']) : ?>
    <hr>
    <a 
    href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" 
    class="btn btn-dark">Edit
    </a>
    <form 
    action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" 
    class="pull-right"
    method="POST"
    >
        <input type="submit" class="btn btn-danger" value="Delete">
    </form>
<?php endif; ?>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>
