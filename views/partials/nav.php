<?php

use core\middlewares\Auth;
use core\middlewares\Url; ?>
<nav id="sidebar" class="px-0 bg-dark-green bg-gradient sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="logo-nav-item">
            <a class="navbar-brand" href="#">
                <img src="<?= Url::home("/assets/logo.png")?>" width="180" height="45" alt="FUTO-SCIT">

            </a>
        </li>

        <li>
            <h6 class="nav-header">



            </h6>
        </li>
        <li class="nav-item">
            <a class='nav-link active' href="<?=Url::home('/portal')?>">
                <i class="batch-icon batch-icon-browser-alt"></i>
                Dashboard <span class="sr-only">(current)</span>
            </a>
        </li>


        <?php
        if (Auth::isStudent(true))
        {
        ?>
        <li class='nav-item'>
            <a href="<?=Url::home('/portal/hostel/invoice')?>"><i class="nav-link fa fa-plus-circle"></i> Generate Hostel Invoice</a>
        </li>

        <li class='nav-item'>
            <a href="<?=Url::home('/portal/siwes')?>"><i class="nav-link fa fa-plus-circle"></i> Generate Siwes Form</a>
        </li>

        <li class='nav-item'>
            <a href="<?=Url::home('/portal/school_fee:generate_invoice')?>"><i class="nav-link fa fa-plus-circle"></i> Generate School Fee Invoice</a>
        </li>

        <li class='nav-item'>
            <a href="<?=Url::home('/portal/course:register')?>"><i class="nav-link fa fa-plus-circle"></i> Register Courses</a>
        </li>

        <li class='nav-item'>
            <a href="<?=Url::home('/portal/result:check')?>"><i class="nav-link fa fa-plus-circle"></i> Check Result</a>
        </li>

        <li class='nav-item'>
            <a href="<?=Url::home('/portal/school_fee:print_receipt')?>"><i class="nav-link fa fa-plus-circle"></i> Print School Fee Receipt</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?=Url::home('/logout')?>">
                <i class="fa fa-lock"></i>
                Logout
            </a>
        </li>
        <?php
        }elseif (Auth::isLecturer(true))
        {
        ?>
        <li class='nav-item'>
            <a href="<?=Url::home('/lecturer/result/upload')?>"><i class="nav-link fa fa-plus-circle"></i> Upload Result</a>
        </li>
            <li class='nav-item'>
                <a href="<?=Url::home('/lecturer/result/view')?>"><i class="nav-link fa fa-plus-circle"></i> View Result</a>
            </li>
        <?php
        }else{
        ?>
            <li class='nav-item'>
                <a href="<?=Url::home('/admin/student/list')?>"><i class="nav-link fa fa-plus-circle"></i> Student List</a>
            </li>
            <li class='nav-item'>
                <a href="<?=Url::home('/admin/lecturer/list')?>"><i class="nav-link fa fa-plus-circle"></i> Lecturer List</a>
            </li>
            <li class='nav-item'>
                <a href="<?=Url::home('/admin/session/view:all')?>"><i class="nav-link fa fa-plus-circle"></i> View Sessions</a>
            </li>
            <li class='nav-item'>
                <a href="<?=Url::home('/admin/course/view:all')?>"><i class="nav-link fa fa-plus-circle"></i> Course List</a>
            </li>
            <li class='nav-item'>
                <a href="<?=Url::home('/admin/result/search')?>"><i class="nav-link fa fa-plus-circle"></i> Search Result</a>
            </li>
        <?php
        }
        ?>

    </ul>



</nav>
