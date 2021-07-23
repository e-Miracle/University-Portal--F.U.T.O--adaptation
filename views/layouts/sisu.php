<?php

use core\View;

View::yield("partials.head");
?>
    <div class="container-fluid">
        <div class="row">
            {{content}}
        </div>
    </div>
<?php
View::yield('partials.script');