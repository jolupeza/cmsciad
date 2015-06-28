<main class="Main">
    <div class="row">
        <div class="col-xs-12">
            <h2>Pages</h2>
            <?php echo anchor('admin/page/edit', 'Add a page <i class="fa fa-plus"></i>'); ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Parent</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($pages)) : foreach($pages as $page) : ?>
                    <tr>
                        <td><?php echo anchor('admin/page/edit/' . $page->id, $page->title); ?></td>
                        <td><?php echo $page->parent_slug; ?></td>
                        <td><?php echo btn_edit('admin/page/edit/' . $page->id); ?></td>
                        <td><?php echo btn_delete('admin/page/delete/' . $page->id); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="4">We could not find any pages.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div><!-- end col-xs-12 -->
    </div><!-- end row -->
</main><!-- end Main -->