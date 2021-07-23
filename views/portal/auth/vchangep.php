<?php

use core\middlewares\Auth;
use core\middlewares\Url; ?>

<div class="col-md-8 col-lg-8">
    <div class="card">
        <div class="card-header">
            CHANGE PASSWORD
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-md-12">


                    <form action="<?=Url::home("$url")?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="matno" class="active">OTP</label>
                            <input type="text" class="form-control" name="otp" placeholder="ENTER OTP" required>
                        </div>

                        <div class="form-group">
                            <div class="waves-input-wrapper waves-effect waves-light"><input class="btn btn-success" name="send" value="Change" type="submit"></div>
                        </div>
                    </form>



                </div>
            </div>

        </div>

    </div>
</div>

<div class="col-md-4 col-lg-4">
    <div class="card card-md">
        <div class="card-header">
            STUDENT DETAILS

        </div>
        <div class="card-body text-center">
            <div class="section quick-rules">
                <h4>Quick Tips</h4>
                <p class="lead">Enter data carefully and crosscheck properly before submitting</p>

                <ul>
                    <li>Captialize words properly</li>
                    <li>Make sure to have entered the correct matno.</li>
                    <li>Enter Matric Number like this: PSC0808900</li>

                </ul>
            </div>
        </div>
    </div>
</div>


<div class="row mb-4">
    <div class="col-md-12 text-center">
        <br><br>
        <footer>

            <!--                                        Copyright &COPY; 2018 NNPC; All Rights Reserved-->
        </footer>
    </div>
</div>

