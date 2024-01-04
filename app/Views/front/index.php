<?php $this->extend('front/layouts/layout'); ?>
<?= $this->section('content'); ?>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <?php //print_r($record) 
            ?>
            <?php foreach ($record as $key => $value) { ?>

                <div class="post-preview">
                    <a href="<?= linkPostSet($value['post_id']); ?>">
                        <h2 class="post-title"><?= ($value['title']) ? $value['title'] : 'Man must explore, and this is exploration at its greatest'; ?> </h2>
                        <h3 class="post-subtitle"><?= ($value['desc']) ? $value['desc'] : 'Problems look mighty small from 150 miles up'; ?></h3>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="#!"><?= ($value['username']) ? writerPost($value['username']) : 'Start Bootstrap'; ?></a>
                        on <?= ($value['created']) ? idForDate($value['created']) : 'September 24, 2023'; ?>
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />
            <?php  } ?>
            <?= $this->endSection(); ?>