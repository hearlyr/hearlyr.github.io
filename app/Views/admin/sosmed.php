<?php $this->extend('admin/templates/layout'); ?>
<?php $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">SOSMED</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Sosmed</li>
        </ol>
        <div class="row">

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Sosmed
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('scs')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('scs'); ?>
                        </div>

                    <?php endif; ?>
                    <div class="row-6 mb-3 ">
                        <div class="col-lg-3 mb-3">
                            <a href="<?= site_url('/sosmed/addsm'); ?>" class="btn btn-success btn-lg">+ ADD sosmed</a>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr class="row" style="color: cadetblue; font-size: 20px;">
                                <th class="col-1">No.</th>
                                <!-- <th class="col">Username</th> -->
                                <th class="col">Sosmed</th>
                                <th class="col">Link</th>
                                <th class="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($record as $d) { ?>
                                <?php $pId = $d['post_id'] ?>
                                <tr class="row">
                                    <td class="col-1 text-center"><?= $number++; ?></td>
                                    <!-- <td class="col"><? //= $d['username']; 
                                                            ?></td> -->
                                    <td class="col"><?= $d['sosmed']; ?></td>
                                    <td class="col"><?= $d['link']; ?></td>
                                    <td class="col text-center">
                                        <a href="<?= site_url("/sosmed/editsm/?post_id=$pId"); ?>" class="btn btn-sm btn-warning">EDIT</a>
                                        <a href="<?= site_url("/sosmed/?act=del&post_id=$pId"); ?>" onclick="return confirm('Delete This sosmed')" class="btn btn-sm btn-danger">DELETE</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-align">

                        <?= $pager->links('sm', 'pagination'); ?>
                    </div>
                </div>
            </div>
        </div>
</main>
<?php $this->endSection(); ?>