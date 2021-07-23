<?php

use app\helpers\App;
use core\middlewares\Url;
?>
<div class="col-md-12">
    <div class="col-md-12 col-lg-12">
        <div class="col-md-12">
            <form class="form-inline" method="post" action="">
                <div class="form-group">
                    <label for="level">Select Level</label>
                    <select class="form-control col-md-12" name="level">
                        <option value="1" selected="">100</option>

                        <option value="2">200</option>

                        <option value="3">300</option>

                        <option value="4">400</option>

                    </select>
                </div>

                <div class="waves-input-wrapper waves-effect waves-light"><input type="submit" name="Load" value="Load" class="btn btn-success"></div>
            </form>
        </div>
        <hr class="section_padding_60">
        <div class="card">
            <div class="card-header">
                Student List
            </div>
            <div class="card-body">

                <?php
                if ($is_set && !empty($students))
                {
                ?>
                <div class="table-responsive">

                    <div id="data_table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatable-1_length"><label>Show <select name="datatable-1_length" aria-controls="datatable-1" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="datatable-1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="datatable-1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="datatable-1" class="table table-datatable table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="datatable-1_info">

                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Fullname: activate to sort column descending" style="width: 234px;">Fullname</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Matno: activate to sort column ascending" style="width: 100px;">Matno</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Faculty: activate to sort column ascending" style="width: 137px;">Faculty</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending" style="width: 154px;">Department</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 48px;">Level</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 148px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                    $class = "odd";
                                    $sn = 1;
                                    foreach ($students as $student)
                                    {
                                    ?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?=$student->fname?> <?=$student->mname?> <?=$student->lname?></td>
                                        <td>
                                            <?=$student->reg_no?>
                                        </td>
                                        <td><?= App::getFaculty($student->faculty)->abbrev?></td>
                                        <td><?=App::getDepartment($student->department)->name?></td>
                                        <td><?=App::getLevel($student->level)->name?></td>

                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-success dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 57px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item" href="<?= Url::home("/admin/edit/student?student=$student->id")?>">Edit Student</a>
                                                    <a class="dropdown-item" href="<?= Url::home("/admin/info/student?student=$student->id")?>">Student Info</a>
                                                    <a class="dropdown-item" href="<?= Url::home("/admin/id_card/student?student=$student->id")?>" target="_blank">ID Card</a>
                                                    <a class="dropdown-item" href="<?= Url::home("/admin/register_course/student?student=$student->id")?>">Register Course</a>
                                                    <a class="dropdown-item" onclick="return confirm('Are you sure you want to cancel?')" href="<?= Url::home("/admin/remove/student?student=$student->id")?>">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        $class = ($class == 'odd')? 'even' : 'odd';
                                        $sn++;
                                    }
                                    ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
                }
                else
                {
                    echo "NO DATA";
                }
                ?>
            </div>
        </div>

    </div>

</div>
