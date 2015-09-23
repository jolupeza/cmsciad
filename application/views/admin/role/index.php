<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Roles</h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('admin'); ?>">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-user-md"></i> Roles
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center Table-checkColumn"><input type="checkbox" name="all" id="all" /></th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( count($roles) ) : ?>
                        <?php foreach ( $roles as $role ) : ?>
                            <tr>
                                <td class="Table-checkColumn"><input type="checkbox" name="role[]" id="role-<?php echo $role->id; ?>" value="<?php echo $role->id; ?>"></td>
                                <td><?php echo $role->role; ?></td>
                                <td class="text-center">
                                    <?php if ( $role->status ) : ?>
                                        <a href="<?php echo site_url("admin/role/edit/$role->id"); ?>" title="Editar <?php echo $role->role; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                    <?php endif; ?>

                                    <a href="<?php echo site_url("admin/role/permissions/$role->id"); ?>" title="Editar permisos"><i class="fa fa-file-text-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-danger">No existen roles</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.row -->
