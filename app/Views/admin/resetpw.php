<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title; ?></title>
    <link href="<?= base_url(); ?>vendor/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <?php $ses = \Config\Services::validation() ?>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <?= date('H:i'); ?>
                                    <h3 class="text-center font-weight-light my-4">RESET PW</h3>
                                </div>
                                <div class="card-body">
                                    <?= session()->get('email'); ?>
                                    <?php if (session()->getFlashdata('msg')) { ?>
                                        <div class="alert alert-warning">
                                            <?= session()->getFlashdata('msg'); ?>
                                        </div>
                                    <?php } ?>
                                    <!-- <br> -->
                                    <?php if (session()->getFlashdata('err')) { ?>
                                        <?php foreach (session()->getFlashdata('err') as $e) { ?>
                                            <div class="alert alert-warning">
                                                <?= $e; ?>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php foreach ($ses->getErrors() as $s) { ?>
                                        <div class="alert alert-warning">
                                            <?= $s; ?>
                                        </div>
                                    <?php } ?>
                                    <form action="" method="post">

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="passwordc" id="passwordc" type="password" />
                                            <label for="passwordc">Password Confirm</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit" name="submit">Reset PW</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>vendor/js/scripts.js"></script>
</body>

</html>