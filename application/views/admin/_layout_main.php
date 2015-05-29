<?php $this->load->view('admin/components/page_head'); ?>

<?php if ($this->User_model->loggedin()) : ?>

    <section class="content">
        <div class="sidebar">
            <nav class="main-menu">
                <ul class="main-menu__list">
                    <li class="main-menu__item">
                        <a href="<?php echo site_url('admin/user'); ?>"><i class="fa fa-user"></i>Usuarios</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="content-liquid-full">
            <div class="container">
                <div class="row header-bar">
                    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 hidden-xs hidden-sm">
                        <ul class="left-icons icon-list">
                            <li>
                                <a href="#" class="collapse-sidebar"><i class="fa fa-bars"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-8">
                        <ul class="right-icons">
                            <li>
                                <a href="#" class="dropdown-toggle user" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-user"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo site_url('admin/user/logout'); ?>"><i class="fa fa-sign-out"></i>Cerrar sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div><!-- end header-bar -->
                <div class="container">

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
                        </div>
                    </div>

                    <?php if (isset($subview)) : ?>
                        <?php $this->load->view($subview); ?>
                    <?php endif; ?>

                </div><!-- end container -->
            </div><!-- end container -->
        </div><!-- end content-liquid-full -->
    </section><!-- end content -->

<?php else : ?>

    <div class="container">

        <?php if (isset($subview)) : ?>
            <?php $this->load->view($subview); ?>
        <?php endif; ?>

    </div><!-- end container -->

<?php endif; ?>

<?php $this->load->view('admin/components/page_tail'); ?>