<?php


namespace app\controllers;


use core\DB;
use core\middlewares\Auth;
use core\Request;

class AjaxController extends \core\Controller
{

    public function getDepartment(Request $request)
    {
        $department = DB::getInstance()->select('department', ['faculty_id', '=', $request->data()->id]);
        if ($department->count())
        {
            $department = $department->fetch();
            foreach ($department as $d)
            {
                echo "<option value='$d->id'>$d->name</option>";
            }
        }else{
            echo "<option value=''>NO DEPARTMENT</option>";
        }
    }

    public static function getState($country_id)
    {
        return $state = DB::getInstance()->select('state', ['country_id', '=', $country_id])->fetch();
    }

    public function getLga(Request $request)
    {
        $lga = DB::getInstance()->select('lga', ['state_id', '=', $request->data()->id]);
        if ($lga->count())
        {
            $lga = $lga->fetch();
            foreach ($lga as $d)
            {
                echo "<option value='$d->id'>$d->name</option>";
            }
        }else{
            echo "<option value=''>NO L.G.A</option>";
        }
    }

    public function getDept(Request $request)
    {
        $request = $request->data();

        $swl = "SELECT * FROM (lecturer_role LEFT JOIN department ON department.id = lecturer_role.department) WHERE user_id = ? AND faculty = ?";
        $dept = DB::getInstance()->query($swl, [Auth::user()->id, $request->id]);

        if ($dept->count())
        {
            $dept = $dept->fetch();
            echo "<option value=\"\">-- select department --</option>";
            foreach ($dept as $d)
            {
                echo "<option value='$d->department'>$d->name</option>";
            }
        }else{
            echo "<option value=''>NO DEPARTMENT</option>";
        }
    }

    public function getLevel(Request $request)
    {
        $request = $request->data();

        $swl = "SELECT * FROM (lecturer_role LEFT JOIN level ON level.id = lecturer_role.level_id) WHERE user_id = ? AND faculty = ? AND department = ?";
        $dept = DB::getInstance()->query($swl, [Auth::user()->id, $request->faculty, $request->department]);

        if ($dept->count())
        {
            echo "<option value=\"\">-- select level --</option>";
            $dept = $dept->fetch();
            foreach ($dept as $d)
            {
                echo "<option value='$d->level_id'>$d->name</option>";
            }
        }else{
            echo "<option value=''>NO LEVEL</option>";
        }
    }

    public function getCourse(Request $request)
    {
        $request = $request->data();

        $swl = "SELECT * FROM (lecturer_role LEFT JOIN courses ON courses.id = lecturer_role.course_id) WHERE user_id = ? AND faculty = ? AND department = ? AND level_id = ?";
        $dept = DB::getInstance()->query($swl, [Auth::user()->id, $request->faculty, $request->department, $request->level]);


        if ($dept->count())
        {
            echo "<option value=\"\">-- select course --</option>";
            $dept = $dept->fetch();
            foreach ($dept as $d)
            {
                echo "<option value='$d->course_id'>$d->title || $d->code</option>";
            }
        }else{
            echo "<option value=''>NO COURSE</option>";
        }
    }
}