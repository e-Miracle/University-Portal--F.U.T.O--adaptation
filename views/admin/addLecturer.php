<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            Add Lecturer
        </div>
        <div class="alert alert-warning">
            <strong>Notice!</strong> Default lecturer password is their email.
        </div>
        <div class="card-body">


            <div class="">
                <form action="" method="post">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="active">First Name</label>

                                <input type="text" name="fname" class="form-control" placeholder="First Name" required=""">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="active">Last Name</label>

                                <input type="text" name="lname" class="form-control" placeholder="Last Name" required=""">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="active">Middle Name</label>

                                <input type="text" name="mname" class="form-control" placeholder="Middle Name" required=""">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="active">Email</label>

                                <input type="email" name="email" class="form-control" required=""">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="active">Sex</label>

                                <select name="sex" id="" class="form-control" required="">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="dob">DOB</label>
                                <input type="date" name="dob" class="form-control" required="">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="semester">Faculty</label>
                                <select class="form-control" name="faculty" required="">
                                    <option value="">--select faculty--</option>
                                    <?php
                                    foreach ($faculty as $f):
                                        ?>
                                        <option value="<?=$f->id?>"><?=$f->abbrev?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="semester">Department</label>
                                <select class="form-control" name="department" required="">
                                    <option value="">--select department--</option>
                                    <?php
                                    foreach ($department as $f):
                                        ?>
                                        <option value="<?=$f->id?>"><?=$f->abbrev?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="card-subtitle">
                        Assign course
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="semester">Faculty</label>
                                <select class="form-control" name="lfaculty" required="">
                                    <option value="">--select faculty--</option>
                                    <?php
                                    foreach ($faculty as $f):
                                        ?>
                                        <option value="<?=$f->id?>"><?=$f->abbrev?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="semester">Department</label>
                                <select class="form-control" name="ldepartment" required="">
                                    <option value="">--select department--</option>
                                    <?php
                                    foreach ($department as $f):
                                        ?>
                                        <option value="<?=$f->id?>"><?=$f->abbrev?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="semester">Level</label>
                                <select class="form-control" name="llevel" required="">
                                    <option value="">--select level--</option>
                                    <?php
                                    foreach ($level as $f):
                                        ?>
                                        <option value="<?=$f->id?>"><?=$f->name?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="semester">Course</label>
                                <select class="form-control" name="lcourse" required="">
                                    <option value="">--select course--</option>
                                    <?php
                                    foreach ($course as $f):
                                        ?>
                                        <option value="<?=$f->id?>"><?=$f->code?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="send" class="btn btn-primary waves-effect waves-light">Save</button>
                </form>
            </div>

        </div>
    </div>
</div>