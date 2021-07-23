<?php
?>
<div class="col-md-8 col-lg-8">
    <div class="card">
        <div class="card-header">
            EDIT PROFILE
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-md-12">
                    <?php

                    use core\middlewares\Auth;
                    use core\middlewares\Url;

                    if (isset($user)){
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="firstname" required="required" value="<?=$user->fname?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="lastname" required="required" value="<?=$user->lname?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="middlename">Middle Name</label>
                                        <input type="text" class="form-control" name="middlename" id="middlename" placeholder="middlename" value="<?=$user->mname?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" name="dob" placeholder="dob" required="required" value="<?=$user->dob?>">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lastname">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="email" required="required" value="<?=$user->email?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lastname">Phone</label>
                                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="phone" required="required" value="<?=$user->phone1?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Sex</label>
                                        <select name="sex" id="" class="form-control" required>
                                            <option value="">--select sex--</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dob">Religion</label>
                                        <select name="rel" id="" class="form-control" required>
                                            <option value="">--select religion--</option>
                                            <option value="christian">Christian</option>
                                            <option value="muslim">Muslim</option>
                                            <option value="traditionalist">Traditionalist</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <hr>
                            <br>
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="userfile">
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="country"> Select Country</label>
                                        <select name="country" id="country" class="form-control" required>
                                            <option value="1">Nigeria</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="state"> Select State</label>
                                        <select class="form-control" id="state" name="state" onchange="getLga(this.value)" required>
                                            <option value="">Select State</option>

                                            <?php
                                            if (isset($state))
                                            {
                                                foreach ($state as $f)
                                                {
                                                    ?>
                                                    <option value="<?=$f->id?>"><?=$f->name?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="state"> Select L.G.A</label>
                                        <select name="lga" id="lga" class="form-control" required>
                                            <option value="">select lga</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Residential Address</label>
                                        <textarea class="form-control" name="res_address" id="resad" cols="30" rows="10" required><?=$user->address1?></textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Permanent Address</label>
                                        <textarea class="form-control" name="pam_address" id="pamad" cols="30" rows="10" required><?=$user->address2?></textarea>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <hr>
                            <br>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Blood group</label>
                                        <input type="text" name="blood_group" class="form-control" required value="<?=$user->blood_group?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Genotype</label>
                                        <input type="text" name="genotype" class="form-control" required value="<?=$user->genotype?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Medical history</label>
                                <textarea name="med_record" id="" cols="30" rows="10" class="form-control"><?=$user->medical_record?></textarea>
                            </div>

                            <br>
                            <hr>
                            <br>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Next of kin name</label>
                                        <input type="text" name="nokname" value="<?=$user->nok_name?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Nok Relationship</label>
                                        <select name="nokrel" id="" class="form-control">
                                            <option value="">--select nok relationship</option>
                                            <option value="father">Father</option>
                                            <option value="mother">Mother</option>
                                            <option value="sister">Sister</option>
                                            <option value="brother">Brother</option>
                                            <option value="uncle">Uncle</option>
                                            <option value="aunt">Aunt</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">NOK email</label>
                                        <input type="text" name="nokemail" value="<?=$user->nok_email?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">NOK phone</label>
                                        <input type="tel" name="nokphone" value="<?=$user->nok_phone?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">NOK address</label>
                                <textarea name="nokaddress" id="" cols="30" rows="10" class="form-control" required><?=$user->nok_address?></textarea>
                            </div>


                            <hr>
                            <div class="form-group">
                                <input class="btn btn-success" name="send" value="Submit" type="submit">
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="col-md-4 col-lg-4">
    <div class="card card-md">
        <div class="card-header">
            PROFILE PICTURE
        </div>
        <div class="card-body text-center">
            <img src="<?=(!is_null(Auth::user()->photo)) ? Url::home('/'. Auth::user()->photo) : Url::home('/assets/no-image.png')?>" height="250" width="300" alt="Passport">
        </div>
    </div>
    <br><br>
    <div class="card card-md">
        <div class="card-header">
            NOTICE!

        </div>
        <div class="card-body text-center">
            <div class="section quick-rules">
                <h4>Quick Tips</h4>
                <p class="lead">Enter data carefully and crosscheck properly before submitting</p>

                <ul>
                    <li>Captialize words properly</li>
                    <li>Make sure to have entered the correct matno.</li>
                    <li>Enter Matric Number like this: PSC0808900</li>

                </ul>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    /*function getDepartment(faculty_id){
        let home = "/<?= WEB_URL ?>";
            $.ajax({
                type: 'post',
                url: home + '/ajax/get/department',
                data: {
                    id: faculty_id,
                },
                success: function (data) {
                    if (data)
                    {
                        $("#dept").html(data)
                    }
                }
            });
    }*/

    function getLga(state_id) {
        let home = "/<?= WEB_URL ?>";
        $.ajax({
            type: 'post',
            url: home + '/ajax/get/lga',
            data: {
                id: state_id,
            },
            success: function (data) {
                if (data)
                {
                    $("#lga").html(data)
                }
            }
        });
    }


</script>