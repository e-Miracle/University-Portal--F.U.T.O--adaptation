<?php
?>
<div class="col-md-12">
    <div class="col-md-12 col-lg-12">

        <div class="card">
            <div class="col-md-12">
                <form class="form-inline" method="post" action="">
                    <div class="form-group">
                        <label for="level">Select Level</label>
                        <select class="form-control col-md-12" name="level" required>
                            <?php
                            foreach ($level as $l)
                            {
                            ?>
                            <option value="<?=$l->numeric?>" ><?=$l->name?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="level">Select Session</label>
                        <select class="form-control col-md-12" name="session" required>
                            <option value="" >-- select session --</option>
                            <?php

                            use core\middlewares\Auth;

                            foreach ($session as $s)
                            {
                            ?>
                            <option value="<?=$s->id?>" ><?=$s->name?> || <?=$s->semester?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <?php
                    if ($addedRegNo)
                    {
                    ?>
                        <div class="form-group">
                            <label for="level">Input Reg No</label>
                            <input type="text" name="reg_no" class="form-control col-md-12" required>
                        </div>
                    <?php
                    }
                    ?>
                    <input type="submit" name="Load" value="Search" class="btn btn-success">
                </form>
            </div>
        </div><br>
        <div class="card">
            <div class="col-md-12">

                <?php
                if (isset($results) && !empty($results))
                {
                    $gp = 0;
                ?>
                <p>
                    <b class="text-info">Name:</b> <?= $user->fname?> <?= $user->lname?><br>
                    <b class="text-info">Degree:</b> B.sc(<?=$department->name?>)<br>
                    <b class="text-info">Reg No:</b> <?= $user->reg_no?><br>
                    <!--<b class="text-info">Level GPA:</b> <span class="gp"></span>-->
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th> <?=$lev?> Level       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Session:  <?=$sess->name?> <?=$sess->semester?></th>
                        </tr>
                        </thead>
                    </table>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Units</th>
                            <th>Raw Score</th>
                            <th>Grade</th>
                            <th>Grade Points</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = 1;
                        foreach ($results as $r)
                        {
                        ?>
                        <tr>
                            <td><?=$n?></td>
                            <td><?=$r->code?></td>
                            <td><?=$r->title?></td>
                            <td><?=$r->load?></td>
                            <td><?=$r->score?></td>
                            <td><?=$r->grade?></td>
                            <?php
                            $sgp = $r->score/$r->load;
                            $gp = $gp + $sgp;
                            ?>
                            <td><?=$sgp?></td>
                        </tr>
                        <?php
                            $n++;
                        }
                        ?>
                        </tbody>
                    </table>
                    <p>
                        <b class="text-info">Level GPA:</b> <span class="<?=$gp?>"></span>
                    </p>
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
    </div>

