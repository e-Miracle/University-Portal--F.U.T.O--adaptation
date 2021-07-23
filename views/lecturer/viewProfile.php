<?php

use core\middlewares\Auth;
use core\middlewares\Url; ?>
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            LECTURER INFO
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-md-12">


                    <table class="table table-responsive">
                        <tr>
                            <td style="text-align: center">
                                <img src="<?=(!is_null(Auth::user()->photo)) ? Url::home('/'. Auth::user()->photo) : Url::home('/assets/no-image.png')?>" height="100" width="100" alt="Passport">
                                <br>

                                <h5><?=Auth::user()->fname. ' '.Auth::user()->mname. ' '. Auth::user()->lname?></h5>

                                <br>
                                <a class="btn btn-success"  href="<?=Url::home('/lecturer/profile:edit')?>"> <i class="fa fa-edit"></i> EDIT INFORMATION</a>
                            </td>
                            <td>
                                <h4>Academic Info</h4>
                                <ul>
                                    <li><i class="fa fa-home"></i> Faculty:  <?=$faculty->name?> </li>
                                    <li><i class="fa fa-home"></i> Department: <?=$department->name?> </li>
                                    <li><i class="fa fa-th"></i> Email:  <?=Auth::user()->email?> </li>
                                </ul>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

