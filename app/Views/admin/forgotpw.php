<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Password Reset</title>
    <link href="<?= base_url(); ?>vendor/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <?php $ses = \Config\Services::session(); ?>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                                </div>
                                <div class="card-body">
                                    <?php if ($ses->getFlashdata('suce')) { ?>
                                        <div class="alert alert-success">
                                            <?= $ses->getFlashdata('suce'); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($ses->getFlashdata('faile')) { ?>
                                        <div class="alert alert-warning">
                                            <?= $ses->getFlashdata('faile'); ?>
                                        </div>
                                    <?php } ?>
                                    <?= session()->get('email'); ?>
                                    <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                    <form action="" method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="useremail" id="useremail" type="text" placeholder="name@example.com" />
                                            <label for="useremail">Email\username</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="<?= site_url(); ?>/admin">Return to login</a>
                                            <button class="btn btn-primary" type="submit" name="submit">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small">Need an account? <a href="#"> Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>vendor/js/scripts.js"></script>
</body>

</html>