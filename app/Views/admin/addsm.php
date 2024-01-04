<?php $this->extend('admin/templates/layout'); ?>
<?php $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><? //= $github; 
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
                    Add an Sosmed
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
                    <?php d($confg); ?>
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
                            <label for="x" class="form-label">Twitter/X</label>
                            <input name="x" type="text" value="<?= (isset($x)) ? $x : $ses->getFlashdata('x'); ?>" class="form-control" id="x" placeholder="Drop a link sosmed...">
                        </div>
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input name="instagram" type="text" value="<?= (isset($instagram)) ? $instagram : $ses->getFlashdata('instagram'); ?>" class="form-control" id="instagram" placeholder="Drop a link sosmed...">
                        </div>
                        <div class="mb-3">
                            <label for="github" class="form-label">Github</label>
                            <input name="github" type="text" value="<?= (isset($github)) ? $github : $ses->getFlashdata('github'); ?>" class="form-control" id="github" placeholder="Drop a link sosmed...">
                        </div>
                        <!-- <div class="input-group mb-3">
                            <label class="input-group-text" for="type">Type</label>
                            <select class="form-select" name="type" value="<? //= old('type'); 
                                                                            ?>" id="type">
                                <option value="article">Sosmed</option>
                                <option value="page">Page</option>
                            </select>
                        </div> -->

                        <button type="submit" name="add" class="btn btn-primary btn-add">Add</button>
                    </form>
                </div>
            </div>
        </div>
</main>
<?php $this->endSection(); ?>