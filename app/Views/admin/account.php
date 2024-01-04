<?php $this->extend('admin/templates/layout'); ?>
<?php $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><? //= $passwordc; 
                            ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><? //= $sub; 
                                                ?></li>
        </ol>
        <div class="row">
            <?php $ses = \Config\Services::session() ?>
            <?php $vals = \Config\Services::validation() ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-smile me-1"></i>
                    Add an Account
                </div>
                <div class="card-body">
                    <?php if ($vals->getErrors()) : ?>
                        <?php foreach ($vals->getErrors() as $val) : ?>
                            <div class="alert alert-warning">
                                <?= $val; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('scs')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('scs'); ?>
                        </div>

                    <?php endif; ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="container-fluid px-4">

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input name="username" type="text" value="<?= (session()->get('username')) ? session()->get('username') : $ses->getFlashdata('username'); ?>" class="form-control" id="username" placeholder="Change username?">
                            </div>
                            <div class="mb-3">
                                <label for="newpw" class="form-label">New Password</label>
                                <input name="newpw" type="password" class="form-control" id="newpw" placeholder="Type a new password...">
                            </div>
                            <div class="mb-3">
                                <label for="passwordc" class="form-label">Confirm Password</label>
                                <input name="passwordc" type="password" class="form-control" id="passwordc" placeholder="Repeat password...">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="oldpw" class="form-label">Old Password</label>
                            <input name="oldpw" type="password" class="form-control" id="oldpw" placeholder="Insert Your Password for Update Data...">
                        </div>
                        <button type="submit" name="add" class="btn btn-primary btn-add">Add</button>
                    </form>
                </div>
            </div>
</main>
<?php $this->endSection(); ?>