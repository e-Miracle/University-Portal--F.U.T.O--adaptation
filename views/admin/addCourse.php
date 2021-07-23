<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <?=$top?>
        </div>
        <div class="card-body">


            <div class="">
                <form action="" method="post">
                    <?php
                    if (isset($id))
                    {
                        echo "<input type='hidden' name='id' value='$id'>";
                    }
                    ?>
                    <div class="form-group">
                        <label class="active">Title</label>

                        <input type="text" name="title" class="form-control" placeholder="Title" required value="<?=$course->title??""?>">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="active">Code</label>

                                <input type="text" name="code" class="form-control" placeholder="e.g CSC 110" required value="<?=$course->code??""?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="active">Credit Load</label>

                                <input type="number" name="load" class="form-control" placeholder="Credit Load" required value="<?=$course->load??""?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-control" name="level" required>
                                    <option value="1">100</option>

                                    <option value="2">200</option>

                                    <option value="3">300</option>

                                    <option value="4">400</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select class="form-control" name="semester" required>
                                    <option value="1">First Semester</option>
                                    <option value="2">Second Semester</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type" required>
                                    <option value="Core">Core</option>
                                    <option value="Elective">Elective</option>
                                    <option value="Mandatory">Mandatory</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="send" class="btn btn-primary waves-effect waves-light">Save</button>
                </form>
            </div>

        </div>
    </div>
</div>