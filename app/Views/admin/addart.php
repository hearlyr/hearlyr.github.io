<?php $this->extend('admin/templates/layout'); ?>
<?php $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">ADD ARTICLE</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">ADD ARTICLE</li>
        </ol>
        <div class="row">
            <?php $ses = \Config\Services::session() ?>
            <?php $vals = \Config\Services::validation() ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Add an Article
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
                    <!-- <?php //if ($ses->getFlashdata('errs')) : 
                            ?>
                        <?php //foreach ($ses->getFlashdata('errs') as $s) : 
                        ?>
                            <div class="alert alert-warning">
                                <? //= $s; 
                                ?>
                            </div>
                        <?php //endforeach; 
                        ?>
                    <?php //endif; 
                    ?> -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input name="title" type="text" value="<?= old('title'); ?>" class="form-control" id="title" placeholder="Post Title">
                        </div>
                        <!-- <div class="input-group mb-3">
                            <label class="input-group-text" for="type">Type</label>
                            <select class="form-select" name="type" value="<?= old('type'); ?>" id="type">
                                <option value="article">Article</option>
                                <option value="page">Page</option>
                            </select>
                        </div> -->
                        <div class="input-group mb-3">
                            <select class="form-select" name="status" value="<?= old('status'); ?>" id="status">
                                <option value="active">Active</option>
                                <option value="inactive">Off</option>
                            </select>
                            <label class="input-group-text" for="status">Status</label>
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail:</label>
                            <input class="form-control" name="thumbnail" value="<?= old('thumbnail'); ?>" type="file" id="thumbnail">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea class="form-control" name="desc" value="<?= old('desc', 'desc'); ?>" id="desc" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="post" class="form-label">Content</label>
                            <textarea class="form-control" name="post" value="<?= old('post'); ?>" id="post" rows="3"></textarea>
                        </div>
                        <button type="submit" name="add" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
</main>
<?php $this->endSection(); ?>