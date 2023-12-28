<?php $this->extend('admin/templates/layout'); ?>
<?php $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">ARTICLE</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Article</li>
        </ol>
        <div class="row">

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Articles
                </div>
                <div class="card-body">
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
                                <tr class="row">
                                    <td class="col-1 text-center"><?= $number++; ?></td>
                                    <!-- <td class="col"><? //= $d['username']; 
                                                            ?></td> -->
                                    <td class="col"><?= $d['title']; ?></td>
                                    <td class="col"><?= $d['post']; ?></td>
                                    <td class="col"><?= idForDate($d['created']); ?></td>
                                    <td class="col text-center">
                                        <img src="/img/<?= $d['thumbnail']; ?>" alt="not an iamge" style="width: 40px; border-radius: 50%;">
                                    </td>
                                    <td class="col text-center"><?= 'edit'; ?></td>
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