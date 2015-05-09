<h3><?php echo empty($article->id) ? 'Add  a new article' : 'Edit article ' . $article->title; ?></h3>

<?php echo validation_errors(); ?>

<?php echo form_open(); ?>

<div class="form-group">
    <label for="">Publication</label>
    <?php echo form_input('pubdate', set_value('pubdate', $article->pubdate)); ?>
</div>

<div class="form-group">
    <label for="">Title</label>
    <?php echo form_input('title', set_value('title', $article->title)); ?>
</div>

<div class="form-group">
    <label for="">Slug</label>
    <?php echo form_input('slug', set_value('slug', $article->slug)); ?>
</div>

<div class="form-group">
    <label for="">Body</label>
    <?php echo form_textarea('body', set_value('body', $article->body), 'class="tinymce"'); ?>
</div>

    <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>

<?php echo form_close(); ?>