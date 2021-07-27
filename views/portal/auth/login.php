<?php
use core\middlewares\Flash;
use core\middlewares\Url;

?>
<div class="right-column sisu">
    <div class="row mx-0">
        <div class="col-md-7 order-md-2 signin-right-column px-5 bg-dark-green">
            <a class="signin-logo d-sm-block d-md-none" href="/" >
                <img style="text-align: center" src="<?= Url::home("/assets/logo.png")?>" width="200" height="48" alt="FleetXpert">
                <!--<img style="text-align: center" src="http://localhost:8080/assets/logo.png" width="200" height="48" alt="FleetXpert">-->
            </a>
            <h1 class="display-4" style="color: white;" >Sign In To get Started</h1>
            <p class="lead mb-5" style="color: white;">
                School Portal is a project developed for the department of Computer Science in Partial fulfillment of the requirements for the Award
                of a MSc in Computer Science.
            </p>
            <br>
            <h3 style="color: white">Important Links</h3>
            <a style="color: black" href="<?=Url::home('/admission/check_status')?>">Check admission status</a>
        </div>
        <div class="col-md-5 order-md-1 signin-left-column bg-white px-5">
            <a class="signin-logo d-sm-none d-md-block" href="/">
                <img src="<?=Url::home("/assets/logo.png")?>"  width="200" height="48" alt="FleetXpert">

            </a>
            <?php Flash::message()?>
            <form  method="POST" action="" >
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"  required autofocus  placeholder="Username">

                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">

                </div>

                <button name="btn_login" type="submit" class="btn btn-success btn-gradient btn-block">
                    <i class="batch-icon batch-icon-key"></i>
                    Sign In
                </button>

            </form>
        </div>
    </div>
</div>