<?php


namespace app\controllers\lecturer;


use app\controllers\BasicSettings;
use core\Controller;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\Csv;
use core\middlewares\File;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;

class ResultController extends Controller
{
use BasicSettings;
    public function __construct()
    {
        $this->setLayout('dashboard');
        Auth::isLoggedIn();
        Auth::isLecturer();
    }

    /**
     * lecturer setting is a trait that holds all settings related to current
     * lecturer
     */
    use LecturerSetting;

    public function resultUpload(Request $request)
    {
        $title = "Upload Result";
        $lev = '';
        $ses = '';
        $fac = '';
        $dept = '';
        $course = '';
        if ($request->method() == 'get') {
            $is_set = false;
        }else{
            $is_set = true;
            $lev = $request->data()->level;
            $ses = $request->data()->session;
            $fac = $request->data()->faculty;
            $dept = $request->data()->department;
            $course = $request->data()->course;
        }
        $level = $this->getAllLevel();
        $swl = "SELECT DISTINCT faculty FROM lecturer_role WHERE user_id = ?";
        $faculty = DB::getInstance()->query($swl, [Auth::user()->id])->fetch();
        $session = $this->getAllSession();
         return $this->view('lecturer.resultUpload', compact('title', 'is_set', 'faculty', 'session', 'ses', 'lev', 'fac', 'dept', 'course', 'level'));
    }

    public function resultView(Request $request)
    {
        $title = "View Result";
        $lev = '';
        $ses = '';
        $fac = '';
        $dept = '';
        $course = '';
        $results = [];
        if ($request->method() == 'get') {
            $is_set = false;
        }else{
            $is_set = true;
            $lev = $request->data()->level;
            $ses = $request->data()->session;
            $fac = $request->data()->faculty;
            $dept = $request->data()->department;
            $course = $request->data()->course;

            $sl = "SELECT * FROM results WHERE `level_id` = ? AND `session_id` = ? AND `course_reg_id` = ? AND status = ?";
            $p = [$lev, $ses, $course, 1];
            $results = DB::getInstance()->query($sl, $p)->fetch();
        }
        $level = $this->getAllLevel();
        $swl = "SELECT DISTINCT faculty FROM lecturer_role WHERE user_id = ?";
        $faculty = DB::getInstance()->query($swl, [Auth::user()->id])->fetch();
        $session = $this->getAllSession();
        return $this->view('lecturer.viewResult', compact('title', 'is_set', 'faculty', 'session', 'ses', 'lev', 'fac', 'dept', 'course', 'level', 'results'));
    }

    public function csvHandler(Request $request)
    {
        $user = Auth::user();
        if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] != 0)
        {
            $check = [
                'max_size'=>'5',
                'type'=>['csv'],
            ];

            $file = new File($_FILES, $check, 'assets/uploads/csv/result/');
            if ($csv = $file->upload()) {
                DB::getInstance()->insert('result_csv', ['user_id' => $user->id, 'csv' => $csv]);

                /**
                 * now csv is uploaded let's continue to convert to array
                 */
                $headers = [
                    'reg_no',
                    'practical',
                    'test',
                    'exam',
                ];

                $ob = (new Csv())->get_array($csv, $headers);

                if ($ob && is_array($ob))
                {
                    /**
                     * if the function returns true, we assume the upload was successful
                     * so we go ahead and loop though the result and store it
                     */
                    foreach ($ob as $key => $value)
                    {
                        //$student = DB::getInstance()->select('users', ['reg_no', '=', $value["reg_no"], 'type', '=', 'student']);
                        $student = DB::getInstance()->query("SELECT * FROM `users` WHERE `reg_no` = ? AND `type` = ?", [$value["reg_no"], 'student']);
                        $student_count = $student->count();
                        $students = $student->fetchOne();

                        if ($student_count)
                        {
                            $student = $students;

                            $data = [
                                $student->id,
                                $request->data()->level,
                                $request->data()->session,
                                $request->data()->course,
                            ];
                            $s = "SELECT * FROM results WHERE user_id = ? AND level_id = ? AND session_id = ? AND course_reg_id = ?";
                            $is_done = DB::getInstance()->query($s, $data);

                            if (!$is_done->count())
                            {
                                if ($value["practical"] == 'NIL')
                                {
                                    if ($value["test"] == 'NIL')
                                    {
                                        if ((int) $value["exam"] <= 100)
                                        {
                                            $score = (int) $value["exam"];
                                        }
                                    }else
                                    {
                                        if (((int) $value["exam"] + (int) $value["test"]) <= 100)
                                        {
                                            $score = (int) $value["exam"] + (int) $value["test"];
                                        }
                                    }
                                }else
                                {
                                    if ($value["test"] == 'NIL')
                                    {
                                        if (((int) $value["exam"] + (int) $value["practical"]) <= 100)
                                        {
                                            $score = (int) $value["exam"] + (int) $value["practical"];
                                        }
                                    }else
                                    {
                                        if (((int) $value["exam"] + (int) $value["test"] + (int) $value["practical"]) <= 100)
                                        {
                                            $score = (int) $value["exam"] + (int) $value["test"] + (int) $value["practical"];
                                        }
                                    }
                                }

                                if ($score >= 70)
                                {
                                    $grade = 'A';
                                }

                                if ($score < 70 AND $score >=60)
                                {
                                    $grade ='B';
                                }

                                if ($score < 60 AND $score >= 50)
                                {
                                    $grade = 'C';
                                }

                                if ($score < 50 AND $score >= 40)
                                {
                                    $grade = 'D';
                                }

                                if($score < 40){
                                    $grade = 'F';
                                }

                                $data = [
                                    'user_id'=>$student->id,
                                    'level_id'=>$request->data()->level,
                                    'session_id'=>$request->data()->session,
                                    'course_reg_id'=>$request->data()->course,
                                    'practical'=>($value["practical"] == 'NIL')? null : $value["practical"],
                                    'test'=>($value["test"] == 'NIL')? null : $value["test"],
                                    'exam'=>$value["exam"],
                                    'score'=>$score??0,
                                    'grade'=>$grade,
                                ];
                                DB::getInstance()->insert('results', $data);
                            }
                        }
                    }
                    Flash::set(['success', 'upload was successful']);
                }

                /**
                 * if i upload something that has no complete
                 * column headers i should be asked to check anc confirm
                 */
                else
                {
                    DB::getInstance()->delete('result_csv', ['csv', '=', $csv]);
                    unlink($csv);
                    Flash::set(['warning', 'please follow the rules in uploading a csv file']);
                }
            }
            else{
                Flash::set(['warning', 'error in file upload']);
            }
        }
        return Redirect::to("/lecturer/result/upload");
    }
}