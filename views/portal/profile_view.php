<?php

use core\middlewares\Auth;
use core\middlewares\Url; ?>
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            STUDENT INFO
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-md-12">


                    <table class="table table-responsive">
                        <tr>
                            <td style="text-align: center">
                                <img src="<?= Url::home('/'. $user->photo)?>" height="100" width="100" alt="Passport">
                                <br>

                                <h5><?=$user->fname. ' '.$user->mname. ' '. $user->lname?></h5>

                                <br>
                                <a class="btn btn-success"  href="<?=Url::home("$edit")?>"> <i class="fa fa-edit"></i> EDIT INFORMATION</a>
                            </td>
                            <td>
                                <h4>Academic Info</h4>
                                <ul>
                                    <li><i class="fa fa-home"></i> Department: <?=$department->name?> </li>
                                    <?php
                                    if (Auth::isStudent(true)):
                                    ?>
                                    <li><i class="fa fa-th"></i> Level:  <?=$user->level?>00 </li>
                                    <li><i class="fa fa-th"></i> Mat No:  <?=$user->reg_no?> </li>
                                    <?php
                                    endif;
                                    ?>
                                </ul>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

