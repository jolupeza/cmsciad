<main class="Main">
    <div class="row">
        <div class="col-xs-12">
            
            <h3><?php echo empty($page->id) ? 'Add  a new page' : 'Edit page ' . $page->title; ?></h3>

            <?php echo form_open('', ['class' => 'form-horizontal']); ?>

                <div class="form-group">
                    <label for="parent_id" class="col-sm-3 control-label">Parent</label>
                    <div class="col-sm-5">
                        <?php echo form_dropdown('parent_id', $pages_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $page->parent_id, 'class="form-control"'); ?>
                    </div>                
                </div>

                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-5">
                        <?php echo form_input('title', set_value('title', $page->title), 'class="form-control"'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="slug" class="col-sm-3 control-label">Slug</label>
                    <div class="col-sm-5">
                        <?php echo form_input('slug', set_value('slug', $page->slug), 'class="form-control"'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="body" class="col-sm-3">Body</label>
                    <div class="col-sm-12">
                        <?php echo form_textarea('body', set_value('body', $page->body), 'class="tinymce"'); ?>
                    </div>
                </div>

                <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>

            <?php echo form_close(); ?>

        </div><!-- end col-xs-12 -->
    </div><!-- end row -->
</main><!-- end Main -->
