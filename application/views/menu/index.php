<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- table data menu-->
    <div class="row">
        <div class="col-lg-6">
            <!-- display if validation error -->
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <!-- add new menu to database -->
            <a href="" class="btn btn-primary mb-3 addData" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>

            <!-- if set session for success add new menu -->
            <?= $this->session->flashdata('message'); ?>
            <div class="setData">

            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>

                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $m['menu'] ?></td>
                        <td>
                            <a href="" class="badge badge-success editData" data-toggle="modal" data-target="#newMenuModal" data-id="<?= $m['id'] ?>">Edit</a>
                            <a href="" class="badge badge-danger deleteData" data-toggle="modal" data-target="#newMenuModal" data-id="<?= $m['id'] ?>">Delete</a>
                        </td>
                    </tr>

                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu') ?>" method="post">
                <input type="hidden" name="id" id="id" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                    </div>
                    <div class="form-group">
                        <select name="role_id" id="role_id" class="form-control">
                            <?php foreach ($role as $r) : ?>
                            <option value="<?= $r['id'] ?>"><?= $r['role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitModal">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 