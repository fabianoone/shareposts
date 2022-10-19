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
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-arrow-left"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit Post</h2>
    <p>Edit the post with this form</p>
    <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input 
            type="text" 
            name="title" 
            id="title" 
            class="form-control form-control-lg 
            <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
            value="<?php echo $data['title']; ?>"
            >
            <span class="invalid-feedback">
                <?php echo (isset($data['title_err']) ? $data['title_err'] : ''); ?>
            </span>
        </div>
        <div class="form-group">
            <label for="body">Body: <sup>*</sup></label>
            <textarea 
            name="body" 
            id="body"
            class="form-control form-control-lg 
            <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
            <span class="invalid-feedback">
                <?php echo (isset($data['body_err']) ? $data['body_err'] : ''); ?>
            </span>
        </div>
        <input type="submit" value="Submit" class="btn btn-success">
    </form>
</div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>
