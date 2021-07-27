<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            Add Department
        </div>
        <div class="card-body">


            <div class="">
                <form action="" method="post">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="semester">Faculty</label>
                                <select class="form-control" name="faculty" required>
                                    <option value="">--select faculty--</option>
                                    <?php
                                    foreach ($faculty as $f):
                                        ?>
                                        <option value="<?=$f->id?>"><?=$f->abbrev?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="active">Department Name</label>

                                <input type="text" name="name" class="form-control" placeholder="Faculty Name" required=""">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="active">Abbreviation</label>

                                <input type="text" name="abbrev" class="form-control" placeholder="Abbreviation" required=""">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                </form>
            </div>

        </div>
    </div>
</div>