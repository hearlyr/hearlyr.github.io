<?php $this->extend('admin/templates/layout'); ?>
<?php $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">PAGE</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Page</li>
        </ol>
        <div class="row">

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Pages
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('scs')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('scs'); ?>
                        </div>

                    <?php endif; ?>
                    <div class="row-6 mb-3 ">
                        <div class="col-lg-3 mb-3">
                            <a href="<?= site_url('/page/addpg'); ?>" class="btn btn-success btn-lg">+ ADD PAGE</a>
                        </div>
                        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="get" action="">
                            <div class="input-group">
                                <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                                <input class="form-control" type="text" name="keyword" value="<?= $keyword; ?>" placeholder="Search..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr class="row" style="color: cadetblue; font-size: 20px;">
                                <th class="col-1">No.</th>
                                <!-- <th class="col">Username</th> -->
                                <th class="col">Title</th>
                                <th class="col">Content</th>
                                <th class="col">Created</th>
                                <th class="col">Thumbnail</th>
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
                                    <td class="col"><?= $d['title']; ?></td>
                                    <td class="col"><?= $d['post']; ?></td>
                                    <td class="col"><?= idForDate($d['created']); ?></td>
                                    <td class="col text-center py-10">
                                        <img src="/img/<?= $d['thumbnail']; ?>" alt="not an iamge" style="width: 40px; border-radius: 5%;">
                                    </td>
                                    <td class="col text-center">
                                        <a href="<?= site_url("/page/editpg/?post_id=$pId"); ?>" class="btn btn-sm btn-warning">EDIT</a>
                                        <a href="<?= site_url("/page/?act=del&post_id=$pId"); ?>" onclick="return confirm('Delete This Page')" class="btn btn-sm btn-danger">DELETE</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-align">

                        <?= $pager->links('pg', 'pagination'); ?>
                    </div>
                </div>
            </div>
        </div>
</main>
<?php $this->endSection(); ?>