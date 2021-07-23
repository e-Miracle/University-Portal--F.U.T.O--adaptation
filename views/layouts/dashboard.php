<?php

use core\View;

View::yield("partials.head");
?>
    <body>
        <div class="container-fluid">
            <div class="row">
                <?php
                    View::yield("partials.nav");
                    ?>
                <div class="right-column">
                    <?php
                        View::yield("partials.navbar");
                    ?>
                    <!--custom style-->
                    <style>
                        #iframe1 {
                            width: 100%;
                            height: 500px;
                            margin:0;
                            padding:0;
                            border:0;
                        }

                        #iframe2 {
                            width: 100%;
                            height: 7000px;
                            margin:0;
                            padding:0;
                            border:0;
                        }
                    </style>

                    <main class="main-content p-5" role="main">
                        <?php
                        \core\middlewares\Flash::message();
                        ?>
                        <div class="row">

                            {{content}}
                        </div>
                    </main>
                    <div class="row mb-4">
                        <div class="col-md-12 text-center">
                            <br><br>
                            <footer>
                                <!--Copyright &COPY; <?/*=date('Y')*/?> eMiracle; All Rights Reserved-->
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
View::yield('partials.script');