<?php

use core\middlewares\Auth; ?>

    <div class="col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                GENERATE SIWES LOG BOOK INVOICE
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">


                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="matno" class="active">MAT NO</label>
                                <input type="text" class="form-control" name="matno" placeholder="MAT NO" readonly value="<?=Auth::user()->reg_no?>">
                            </div>

                            <div class="form-group">
                                <label for="firstname" class="active">Firstname</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="firstname" readonly value="<?=Auth::user()->fname?>">
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="active">Lastname</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="lastname" readonly value="<?=Auth::user()->lname?>">
                            </div>

                            <div class="form-group">
                                <label for="middlename" class="active">Middle Name</label>
                                <input type="text" class="form-control" name="middlename" id="middlename" placeholder="middlename" readonly value="<?=Auth::user()->mname?>">
                            </div>
                            <div class="form-group">
                                <label for="division">Faculty</label>

                                <select class="form-control" id="division" name="faculty">
                                    <option value="<?=$faculty->id?>"><?=$faculty->name?></option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control" id="department" name="department">
                                    <option value="<?=$department->id?>"><?=$department->name?></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-control" name="level">
                                    <option value="200">200</option>

                                    <option value="300">300</option>

                                    <option value="400">400</option>

                                </select>
                            </div>


                            <div class="form-group">
                                <div class="waves-input-wrapper waves-effect waves-light"><input class="btn btn-success" name="send" value="Generate" type="submit"></div>
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

