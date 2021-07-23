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
                            use core\middlewares\Auth;
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
                <div class="col-md-12">

                    <?php
                    if (isset($results) && !empty($results))
                    {
                        $gp = 0;
                        ?>
                        <p>
                            <b class="text-info">Faculty:</b> <?= App::getFaculty($fac)->name?><br>
                            <b class="text-info">Department:</b> B.sc(<?=App::getDepartment($dept)->name?>)<br>
                            <b class="text-info">Level:</b> <?= App::getLevel($lev)->name?><br>
                            <b class="text-info">Course:</b> <?= App::getCourse($course)->code?><br>
                            <!--<b class="text-info">Level GPA:</b> <span class="gp"></span>-->
                        </p>
                        <div class="table-responsive">

                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Reg no</th>
                                    <th>Full Name</th>
                                    <th>Practical</th>
                                    <th>Test</th>
                                    <th>Exam</th>
                                    <th>Grade</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $n = 1;
                                foreach ($results as $r)
                                {
                                    $user = Auth::user($r->user_id);
                                    ?>
                                    <tr>
                                        <td><?=$n?></td>
                                        <td><?=$user->reg_no?></td>
                                        <td><?=$user->fname .' '. $user->lname?></td>
                                        <td><?=$r->practical?></td>
                                        <td><?=$r->test?></td>
                                        <td><?=$r->exam?></td>
                                        <td><?=$r->grade?></td>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }else{
                        ?>
                        <h3>NO RECORD FOUND</h3>
                        <?php
                    }
                    ?>
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