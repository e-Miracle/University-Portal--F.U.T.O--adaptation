<?php
?>
<div class="col-md-12">
    <div class="col-md-12 col-lg-12">

        <div class="card">
            <div class="card-header">
                STEP 1
            </div>
            <div class="card-body">

                <form class="form-inline" method="post" action="">
                    <div class="form-group">
                        <label for="level">Select Session</label>
                        <select class="form-control col-md-12" name="session" required>
                            <?php

                            use app\helpers\App;
                            use core\middlewares\Url;

                            foreach ($session as $s)
                            {
                                $class ='';
                                if ($s->status == 1)
                                {
                                    $class = "selected";
                                }
                                ?>
                                <option value="<?=$s->id?>" <?=$class?>><?=$s->name?> || <?=$s->semester?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="level">Select Faculty</label>
                        <select class="form-control col-md-12" name="faculty" onchange="getDepartment(this.value)" id="faculty" required>
                            <option value="">-- select faculty --</option>
                            <?php
                            foreach ($faculty as $f)
                            {
                                $f = App::getFaculty($f->faculty);
                            ?>

                            <option value="<?=$f->id?>"><?=$f->name?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="level">Select Department</label>
                        <select class="form-control col-md-12" name="department" id="department" onchange="getLevel(this.value)" required>
                            <option value="">-- select department --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="level">Select Level</label>
                        <select class="form-control col-md-12" name="level" id="level" onchange="getCourse(this.value)" required>
                            <option value="">-- select level --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="level">Select Course</label>
                        <select class="form-control col-md-12" name="course" id="course" required>
                            <option value="">-- select course --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="Load" value="Set session" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>

        <?php
        if ($is_set)
        {
        ?>
            <hr class="section_padding_60">
            <div class="card">
                <div class="card-header">
                    SELECTED DETAILS
                </div>
                <div class="card-body">
                    <?php
                    $s = App::getSession($ses);
                    $f = App::getFaculty($fac);
                    $d = App::getDepartment($dept);
                    $l = App::getLevel($lev);
                    $c = App::getCourse($course);
                    ?>
                    <span><b>SESSION:</b> <?=$s->name?> || <?=$s->semester?></span>
                    <span><b>FACULTY:</b> <?=$f->name?></span>
                    <span><b>DEPARTMENT:</b> <?=$d->name?></span>
                    <span><b>LEVEL:</b> <?=$l->name?></span>
                    <span><b>COURSE:</b> <?=$c->title?> || <?=$c->code?></span>
                </div>
            </div>
            <hr class="section_padding_60">
        <div class="card">
            <div class="card-header">
                STEP 2
            </div>
            <div class="card-body">

                <div class="text-center">
                    <form class="form-inline" method="post" enctype="multipart/form-data" action="<?= Url::home('/lecturer/result/upload/import:csv')?>">
                        <div class="form-group">
                            <label for="level">Upload a CSV</label>
                            <input type="hidden" name="session" value="<?=$ses?>">
                            <input type="hidden" name="faculty" value="<?=$fac?>">
                            <input type="hidden" name="department" value="<?=$dept?>">
                            <input type="hidden" name="level" value="<?=$lev?>">
                            <input type="hidden" name="course" value="<?=$course?>">
                            <input type="file" name="userfile">
                        </div>

                        <input type="submit" value="upload" class="btn btn-success">
                    </form>
                </div>
<!--
                <br>
                <div class="text-center">
                    <span style="font-size: x-large">OR</span>
                </div>
                <br>

                <form class="form-inline" method="post" enctype="multipart/form-data" action="<?/*= Url::home('/lecturer/result/upload/manual')*/?>">
                    <div class="form-group">
                        <input type="hidden" name="session" value="<?/*=$ses*/?>">
                        <input type="hidden" name="faculty" value="<?/*=$fac*/?>">
                        <input type="hidden" name="department" value="<?/*=$dept*/?>">
                        <input type="hidden" name="level" value="<?/*=$lev*/?>">
                        <input type="hidden" name="course" value="<?/*=$course*/?>">
                    </div>

                    <input type="submit" value="upload manually" class="btn btn-success">
                </form>-->
            </div>
        </div>

        <hr class="section_padding_60">
        <div class="card">
            <div class="card-header">
                generate report
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <!--<a href="http://localhost:9000/dashboard/export_result"  class="btn btn-primary">Export Result</a>
                    <a href="http://localhost:9000/dashboard/success_result"  class="btn btn-success">Success Students</a>
                    <a href="http://localhost:9000/dashboard/senate_report"  class="btn btn-success">Generate Senate Report</a>-->
                </div>
            </div>
        </div>
        <?php
        }
        ?>

    </div>

</div>
</div>

<script>
    function getDepartment(faculty) {
        let home = "/<?= WEB_URL ?>";
        $.ajax({
            type: 'post',
            url: home + '/ajax/get/dept',
            data: {
                id: faculty,
            },
            success: function (data) {
                if (data)
                {
                    $("#department").html(data)
                }
            }
        });
    }

    function getLevel(dept) {

        const faculty = $("#faculty").val();
        let home = "/<?= WEB_URL ?>";
        $.ajax({
            type: 'post',
            url: home + '/ajax/get/lev',
            data: {
                faculty: faculty,
                department: dept
            },
            success: function (data) {
                if (data)
                {
                    $("#level").html(data)
                }
            }
        });
    }

    function getCourse(level) {

        const faculty = $("#faculty").val();
        const dept = $("#department").val();
        let home = "/<?= WEB_URL ?>";
        $.ajax({
            type: 'post',
            url: home + '/ajax/get/course',
            data: {
                faculty: faculty,
                department: dept,
                level: level
            },
            success: function (data) {
                if (data)
                {
                    $("#course").html(data)
                }
            }
        });
    }
</script>