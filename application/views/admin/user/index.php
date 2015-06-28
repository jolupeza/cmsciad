<main class="Main">
    <div class="row">
        <div class="col-xs-12">            
            <h2>Users</h2>
            <?php echo anchor('admin/user/edit', 'Add a user <i class="fa fa-plus"></i>'); ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($users)) : foreach($users as $user) : ?>
                    <tr>
                        <td><?php echo anchor('admin/user/edit/' . $user->id, $user->email); ?></td>
                        <td><?php echo btn_edit('admin/user/edit/' . $user->id); ?></td>
                        <td><?php echo btn_delete('admin/user/delete/' . $user->id); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="3">We could not find any users.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>              
        </div><!-- end col-xs-12 -->
    </div><!-- end row -->
</main><!-- end Main -->