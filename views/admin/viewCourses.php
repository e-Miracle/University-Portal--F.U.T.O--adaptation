<?php

use app\helpers\App;
use core\middlewares\Url;
?>
<div class="col-md-12">
    <div class="col-md-12 col-lg-12">
        <div class="col-md-12">
            <button class="btn btn-primary">
                <a href="<?=Url::home("/admin/course/add")?>" style="color: white">Add course</a>
            </button>

        </div>
        <hr class="section_padding_60">
        <div class="card">
            <div class="card-header">
                course List
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <div id="data_table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatable-1_length"><label>Show <select name="datatable-1_length" aria-controls="datatable-1" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="datatable-1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="datatable-1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="datatable-1" class="table table-datatable table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="datatable-1_info">

                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Fullname: activate to sort column descending" style="width: 134px;">Title</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Matno: activate to sort column ascending" style="width: 100px;">Code</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Faculty: activate to sort column ascending" style="width: 137px;">Credit Load</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending" style="width: 154px;">Semester</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending" style="width: 154px;">Type</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending" style="width: 154px;">Level</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 148px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                    $class = "odd";
                                    $sn = 1;
                                    foreach ($courses as $course)
                                    {
                                        ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1"><?=$course->title?></td>
                                            <td>
                                                <?=$course->code?>
                                            </td>
                                            <td>
                                                <?=$course->load?>
                                            </td>
                                            <td><?= $course->semester?></td>
                                            <td><?= $course->type?></td>
                                            <td><?= App::getLevel($course->level)->name?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupVerticalDrop2" type="button" class="btn btn-success dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 57px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href="<?= Url::home("/admin/course/edit?course=$course->id")?>">Edit course</a>
                                                        <a class="dropdown-item" onclick="return confirm('Are you sure you want to cancel?')" href="<?= Url::home("/admin/course/remove?course=$course->id")?>">Delete</a>
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
            </div>
        </div>

    </div>

</div>
