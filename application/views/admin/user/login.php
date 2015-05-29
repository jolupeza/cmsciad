<div class="row">
	<div class="col-xs-12">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert--login" role="alert">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger alert--login" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

		<section class="login-container">

			<?php echo form_open(); ?>

				<div class="form-group">
				    <label for="email" class="sr-only">Email</label>
				    <div class="input-group">
						<span class="input-group-addon frm-input-group-addon"><i class="fa fa-user"></i></span>
						<?php
							$data = array(
                                                            'type' => 'email',
                                                            'name'        => 'email',
                                                            'id'          => 'email',
                                                            'class'       => 'form-control frm-input',
                                                            'placeholder' => 'Email',
                                                            'required' => 'required'
							);
							echo form_input($data);
						?>
				    </div><!-- end input-group -->
				</div>

				<div class="form-group">
				    <label for="password" class="sr-only">Password</label>
				    <div class="input-group">
				    	<span class="input-group-addon frm-input-group-addon"><i class="fa fa-lock"></i></span>
					    <?php
					    	$data = array(
								'name'        => 'password',
								'id'          => 'password',
								'class'       => 'form-control frm-input',
								'placeholder' => 'Password',
                                                                'required' => 'required'
							);
					    	echo form_password($data);
					    ?>
				    </div>
				</div>

			    <?php echo form_submit('submit', 'Log in', 'class="btn btn-lg button--black button--submit"'); ?>

			<?php echo form_close(); ?>

		</section><!-- end login-container -->

	</div><!-- end col-xs-12 -->
</div><!-- end row -->
