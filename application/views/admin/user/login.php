<?php echo validation_errors(); ?>

<?php echo form_open(); ?>

<div class="form-group">
    <label for="">Email</label>
    <?php echo form_input('email'); ?>
</div>

<div class="form-group">
    <label for="">Password</label>
    <?php echo form_password('password'); ?>
</div>

    <?php echo form_submit('submit', 'Log in', 'class="btn btn-primary"'); ?>

<?php echo form_close(); ?>