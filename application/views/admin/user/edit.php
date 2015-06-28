<main class="Main">
    
    <div class="row">
        <div class="col-xs-12">
            
            <?php if (!isset($errors)) : ?>

                <h3><?php echo empty($user->id) ? 'Add  a new user' : 'Edit user ' . $user->name; ?></h3>

                <?php echo form_open('', ['class' => 'form-horizontal']); ?>

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-5">
                        <?php echo form_input('name', set_value('name', $user->name), 'class="form-control"'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-5">
                        <?php echo form_input('email', set_value('email', $user->email), 'class="form-control"'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-5">
                        <?php echo form_password('password', '', 'class="form-control"'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirm" class="col-sm-3 control-label">Confirm Password</label>
                    <div class="col-sm-5">
                        <?php echo form_password('password_confirm', '', 'class="form-control"'); ?>
                    </div>
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
            
        </div><!-- end col-xs-12 -->
    </div><!-- end row -->  

</main><!-- end Main -->