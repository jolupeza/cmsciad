<h3><?php echo empty($page->id) ? 'Add  a new page' : 'Edit page ' . $page->title; ?></h3>

<?php echo validation_errors(); ?>

<?php echo form_open(); ?>

<div class="form-group">
    <label for="">Parent</label>
    <?php echo form_dropdown('parent_id', $pages_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $page->parent_id); ?>
</div>

<div class="form-group">
    <label for="">Title</label>
    <?php echo form_input('title', set_value('title', $page->title)); ?>
</div>

<div class="form-group">
    <label for="">Slug</label>
    <?php echo form_input('slug', set_value('slug', $page->slug)); ?>
</div>

<div class="form-group">
    <label for="">Body</label>
    <?php echo form_textarea('body', set_value('body', $page->body), 'class="tinymce"'); ?>
</div>

    <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>

<?php echo form_close(); ?>