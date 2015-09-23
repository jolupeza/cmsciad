<?php $this->load->view('frontend/components/page_head'); ?>

    <?php if ( isset($subview) ) : ?>
        <?php $this->load->view($subview); ?>
    <?php endif; ?>

<?php $this->load->view('frontend/components/page_tail'); ?>