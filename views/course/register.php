<?php

use core\middlewares\Auth; ?>
<div class="col-md-12 col-lg-12">
    <table class="table table-bordered">
        <tbody><tr>
            <td style="border-color: #000; font-weight: 800;">Name: <?= $user->fname?> <?= $user->lname?></td>
            <td style="border-color: #000; font-weight: 800;">Reg No: <?= $user->reg_no?></td>
            <td style="border-color: #000; font-weight: 800;">Level: <?= $user->level?>00</td>
            <td style="border-color: #000; font-weight: 800;">Session: <?=$session->name?> <?=$session->semester?></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            Courses List
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <form method="post" id="form1" action="">
                    <input type="hidden" name="id" value="<?=$user->id?>">
                    <div id="datatable-1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable-1" class="table table-datatable table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="datatable-1_info">

                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=": activate to sort column descending" style="width: 12px;"></th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Course: activate to sort column ascending" style="width: 117px;">Course</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Code: activate to sort column ascending" style="width: 51px;">Code</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Code: activate to sort column ascending" style="width: 51px;">Type</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Credit: activate to sort column ascending" style="width: 40px;">Credit</th></tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    /**
                                     * class here holds the class of the datatable
                                     * either odd or even
                                     */
                                    $class = 'odd';

                                    /**
                                     * ch holds the checked state of the checkbox
                                     */
                                    $ch = "";
                                    $n = 0;
                                    $t = 0;
                                    foreach ($courses as $c)
                                    {
                                        $ch = "";
                                        foreach ($creg as $r) {
                                            if ($r->course_id === $c->id) {
                                                $n++;
                                                $t = $t + $c->load;
                                                $ch = "checked";
                                            }
                                        }
                                    ?>
                                    <tr role="row" class="<?=$class?>">
                                        <td class="sorting_1">
                                            <input type="checkbox" name="<?=$c->id?>" value="" <?=$ch?>>
                                        </td>
                                        <td><?=$c->title?></td>
                                        <td>
                                            <?=$c->code?>
                                        </td>
                                        <td>
                                            <?=$c->type?>
                                        </td>
                                        <td>
                                            <?=$c->load?>
                                        </td>
                                    </tr>
                                    <?php
                                    ($class = 'odd')? $class = 'even': $class = 'odd';
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr class="bg-success">
                                        <td colspan="4">Total Credits Registered:</td>
                                        <td><?=$t?></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="add" name="add" class="btn btn-primary waves-effect waves-light">Register </button>
                </form>


            </div>

        </div>
    </div>

</div>
