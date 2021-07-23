<?php
?>
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            Edit Session
        </div>
        <div class="card-body">


            <div class="row">
                <form action="" method="post">

                    <div class="form-group">
                        <label class="active">Session</label>
                        <input type="hidden" name="id" value="<?$session->id?>">
                        <input type="text" name="session" class="form-control" placeholder="Session" value="<?=$session->name?>">
                    </div>

                    <button type="submit" name="send" class="btn btn-primary waves-effect waves-light">Save</button>
                </form>
            </div>

        </div>
    </div>
</div>
