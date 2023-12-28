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
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <?= date('H:i'); ?>
                                    <h3 class="text-center font-weight-light my-4">LOGIN</h3>
                                </div>
                                <div class="card-body">
                                    <?= session()->get('email'); ?>
                                    <?php if (session()->getFlashdata('msg')) { ?>
                                        <div class="alert alert-warning">
                                            <?= session()->getFlashdata('msg'); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (session()->getFlashdata('out')) { ?>
                                        <div class="alert alert-danger">
                                            <?= session()->getFlashdata('out'); ?>
                                        </div>
                                    <?php } ?>
                                    <form action="" method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="useremail" id="useremail" type="text" placeholder="name@example.com" />
                                            <label for="useremail">Email/Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" name="remember" id="remember" type="checkbox" value="1" />
                                            <label class="form-check-label" for="remember">Remember Me?</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit" name="submit">Login</button>
                                        </div>
                                    </form>
                                    <a class="small" href="<?= site_url('/admin/forgotpw'); ?>">Forgot Password?</a>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small">Need an account? <a href="#">Sign up!</a></div>
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
    <script src="<?= base_url() ?>vendor/js/scripts.js"></script>
</body>

</html>