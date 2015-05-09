<?php $this->load->view('admin/components/page_head'); ?>
    <body>
        <h1>Hello, world!</h1>
        <?php if(isset($subview)) : ?>
            <?php $this->load->view($subview); ?>
        <?php endif; ?>
<?php $this->load->view('admin/components/page_tail'); ?>