<main class="Main">
    <div class="row">
        <div class="col-xs-12">
            
            <h3><?php echo empty($article->id) ? 'Add  a new article' : 'Edit article ' . $article->title; ?></h3>

            <?php echo form_open('', ['class' => 'form-horizontal']); ?>

            <div class="form-group">
                <label for="pubdate" class="col-sm-3 control-label">Publication</label>
                <div class="col-sm-5">
                     <?php echo form_input('pubdate', set_value('pubdate', $article->pubdate), 'class="form-control"'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Title</label>
                <div class="col-sm-5">
                    <?php echo form_input('title', set_value('title', $article->title), 'class="form-control"'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="slug" class="col-sm-3 control-label">Slug</label>
                <div class="col-sm-5">
                    <?php echo form_input('slug', set_value('slug', $article->slug), 'class="form-control"'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="body" class="col-sm-3">Body</label>
                <div class="col-sm-12">
                    <?php echo form_textarea('body', set_value('body', $article->body), 'class="tinymce form-control"'); ?>
                </div>
            </div>

                <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>

            <?php echo form_close(); ?>
            
        </div><!-- end col-xs-12 -->
    </div><!-- end row -->
</main><!-- end Main -->

