<?php $this->extend('front/layouts/layout'); ?>
<?= $this->section('content'); ?>
<p>Need to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
<div class="my-5">
    <?php if (session()->getFlashdata('scs')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('scs'); ?>
        </div>

    <?php endif; ?>
    <!-- * * * * * * * * * * * * * * *-->
    <!-- * * SB Forms Contact Form * *-->
    <!-- * * * * * * * * * * * * * * *-->
    <!-- This form is pre-integrated with SB Forms.-->
    <!-- To make this form functional, sign up at-->
    <!-- https://startbootstrap.com/solution/contact-forms-->
    <!-- to get an API token!-->
    <form id="contactForm" action="" method="post" data-sb-form-api-token="API_TOKEN">
        <div class="form-floating">
            <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" value="<?= (isset($name)) ? $name : ''; ?>" />
            <label for="name">Name</label>
            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
        </div>
        <div class="form-floating">
            <input class="form-control" name="email" id="email" type="email" placeholder="Enter your email..." data-sb-validations="required,email" value="<?= (isset($email)) ? $email : '' ?>" />
            <label for="email">Email address</label>
            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
        </div>
        <div class="form-floating">
            <input class="form-control" name="phone" id="phone" type="tel" placeholder="Enter your phone number..." data-sb-validations="required" value="<?= (isset($phone)) ? $phone : ''; ?>" />
            <label for="phone">Phone Number</label>
            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
        </div>
        <div class="form-floating">
            <textarea class="form-control" name="message" id="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
            <label for="message">Message</label>
            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
        </div>
        <br />
        <!-- Submit success message-->
        <!---->
        <!-- This is what your users will see when the form-->
        <!-- has successfully submitted-->
        <div class="d-none" id="submitSuccessMessage">
            <div class="text-center mb-3">
                <div class="fw-bolder">Form submission successful!</div>
                To activate this form, sign up at
                <br />
                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
            </div>
        </div>
        <!-- Submit error message-->
        <!---->
        <!-- This is what your users will see when there is-->
        <!-- an error submitting the form-->
        <div class="d-none" id="submitErrorMessage">
            <div class="text-center text-danger mb-3">Error sending message!</div>
        </div>
        <!-- Submit Button-->
        <!-- <button class="btn btn-primary text-uppercase disabled" id="submitButton" type="submit" name="send">Send</button> -->
        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit" name="send">Send</button>
    </form>
    <?= $this->endSection(); ?>