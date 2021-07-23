<?php

use core\middlewares\Auth;
use core\middlewares\Url; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-dark-green">
    <a class="navbar-brand d-block d-sm-block d-md-block d-lg-none" href="#">
        <img src="<?= Url::home("/assets/logo.png")?>" width="180" height="45" alt="FUTO-SCIT">
    </a>
    <button class="hamburger hamburger--slider" type="button" data-target=".sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle Sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
    </button>
    <!-- Added Mobile-Only Menu -->
    <ul class="navbar-nav ml-auto mobile-only-control d-block d-sm-block d-md-block d-lg-none">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbar-notification-search-mobile" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                <i class="batch-icon batch-icon-search"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-fullscreen" aria-labelledby="navbar-notification-search-mobile">
                <li>
                    <form class="form-inline my-2 my-lg-0 no-waves-effect">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for..." aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-gradient waves-effect waves-light" type="button">
                                    <i class="batch-icon batch-icon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </li>
    </ul>

    <?php
    /**
     * differentiate between lecturers, users, and admins url in navbar
     * we will do this using an variable called @type
     */
    if (Auth::isLecturer(true))
    {
        $type = 'lecturer';
    }elseif (Auth::isStudent(true))
    {
        $type = 'portal';
    }else
    {
        $type = 'admin';
    }
    ?>
    <!--  DEPRECATED CODE:
        <div class="navbar-collapse" id="navbarSupportedContent">
    -->
    <!-- USE THIS CODE Instead of the Commented Code Above -->
    <!-- .collapse added to the element -->
    <div class="collapse navbar-collapse" id="navbar-header-content">
        <ul class="navbar-nav navbar-language-translation mr-auto">

        </ul>

        <ul class="navbar-nav ml-5 navbar-profile">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbar-dropdown-navbar-profile" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                    <div class="profile-name">
                        <?php
                        if (Auth::isLoggedIn())
                        {
                            if (Auth::isLecturer(true))
                            {
                                echo Auth::user()->fname. ' '. Auth::user()->lname;
                            }elseif (Auth::isStudent(true))
                            {
                                echo Auth::user()->reg_no;
                            }else
                            {
                                echo "Admin";
                            }
                        }
                        ?>
                        </div>
                    <div class="profile-picture bg-gradient bg-primary has-message float-right">

                        <img src="<?=Url::home("/assets/uploads/default.jpg")?>" width="44" height ="44">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-navbar-profile">

                    <li>
                        <a class="dropdown-item" href="<?=Url::home("/$type/profile")?>">
                            View Profile
                        </a>

                    </li>
                    <li>
                        <a class="dropdown-item" href="<?=Url::home("/$type/profile/edit")?>">
                            Edit Profile
                        </a>

                    </li>
                    <li>
                        <a class="dropdown-item" href="<?=Url::home("/$type/password/change")?>">
                            Change Password
                        </a>

                    </li>
                    <li>
                        <a class="dropdown-item" href="<?=Url::home('/logout')?>">
                            Logout
                        </a>

                    </li>

                </ul>
            </li>
        </ul>
    </div>
</nav>
