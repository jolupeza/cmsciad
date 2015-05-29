<?php if (!isset($errors)) : ?>

    <h3><?php echo empty($user->id) ? 'Add  a new user' : 'Edit user ' . $user->name; ?></h3>

    <?php echo form_open(); ?>

    <div class="form-group">
        <label for="">Name</label>
        <?php echo form_input('name', set_value('name', $user->name)); ?>
    </div>

    <div class="form-group">
        <label for="">Email</label>
        <?php echo form_input('email', set_value('email', $user->email)); ?>
    </div>

    <div class="form-group">
        <label for="">Password</label>
        <?php echo form_password('password'); ?>
    </div>

    <div class="form-group">
        <label for="">Confirm Password</label>
        <?php echo form_password('password_confirm'); ?>
    </div>

    <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>

    <?php echo form_close(); ?>

<?php else : ?>
    
    <div class="alert alert-danger alert--login" role="alert">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>

<?php endif; ?>