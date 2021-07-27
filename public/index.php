<?php
/**
session start and security checks
 */
ini_set('date.timezone', 'Africa/Lagos');
ini_set( 'session.cookie_httponly', 1 );
//ini_set( 'session.cookie_secure', true);
ini_set( 'session.cookie_lifetime', 0);
//ini_set( 'session.use_strict_mode', 1);

//change session name
session_name('CRUIZTOPIA_TOURS');

//start session
session_start();


//x-xss protection
header("X-XSS-Protection: 1; mode=block");


require_once __DIR__ . "/../config/App.php";

require_once BASE_URL."/vendor/autoload.php";

error_reporting(E_ALL);
set_error_handler('core\Error::errorHandler');
set_exception_handler('core\Error::exceptionHandler');

use core\Application;

$app = new Application();

//$app->router->get('/', ['controller'=>'MainController', 'action'=>'home', 'namespace'=>'']);

$app->router->get('/', ['controller'=>'HomeController', 'action'=>'home']);

/**
 * here i will write routes for portal side
 */
$app->router->get('/portal', ['controller'=>'DashboardController', 'action'=>'home', 'namespace'=>'portal']);
$app->router->get('/lecturer', ['controller'=>'DashboardController', 'action'=>'home', 'namespace'=>'portal']);

/**
 * here we will create sub urls
 */

/**
 * profile routes
 */
$app->router->get('/portal/profile', ['controller'=>'ProfileController', 'action'=>'viewProfile', 'namespace'=>'portal']);
$app->router->get('/portal/profile/edit', ['controller'=>'ProfileController', 'action'=>'editProfile', 'namespace'=>'portal']);
$app->router->post('/portal/profile/edit', ['controller'=>'ProfileController', 'action'=>'submitEditedProfile', 'namespace'=>'portal']);

/**
 * auth routes
 */
$app->router->get('/login', ['controller'=>'AuthController', 'action'=>'viewLoginForm']);
$app->router->post('/login', ['controller'=>'AuthController', 'action'=>'logUserIn']);
$app->router->get('/logout', ['controller'=>'Logout', 'action'=>'logout']);

/**
 * ajax routes
 */
$app->router->post('/ajax/get/department', ['controller'=>'AjaxController', 'action'=>'getDepartment']);
$app->router->post('/ajax/get/lga', ['controller'=>'AjaxController', 'action'=>'getLga']);
$app->router->post('/ajax/get/dept', ['controller'=>'AjaxController', 'action'=>'getDept']);
$app->router->post('/ajax/get/lev', ['controller'=>'AjaxController', 'action'=>'getLevel']);
$app->router->post('/ajax/get/course', ['controller'=>'AjaxController', 'action'=>'getCourse']);

/**
 * test route
 */

$app->router->get('/test', ['controller'=>'TestController', 'action'=>'test']);

/**
 * pre admission routes
 */

$app->router->get('/admission/check_status', ['controller'=>'AdmissionController', 'action'=>'statusView', 'namespace'=>'admission']);
$app->router->post('/admission/check_status', ['controller'=>'AdmissionController', 'action'=>'checkStatus', 'namespace'=>'admission']);
$app->router->post('/admission/pay_acceptance', ['controller'=>'AdmissionController', 'action'=>'generateRemitaReferenceNumber', 'namespace'=>'admission']);

/**
 * SIWES concern
 */
$app->router->get('/portal/siwes', ['controller'=>'SiwesController', 'action'=>'generate']);
$app->router->post('/portal/siwes', ['controller'=>'SiwesController', 'action'=>'generateInvoice']);

/**
 * Hotel concern
 */
$app->router->get('/portal/hostel/invoice', ['controller'=>'HostelController', 'action'=>'generate']);

/**
 * Password Change route
 */
$app->router->get('/portal/password/change', ['controller'=>'ProfileController', 'action'=>'changePassword', 'namespace'=>'portal']);
$app->router->post('/portal/password/change', ['controller'=>'ProfileController', 'action'=>'submitPassword', 'namespace'=>'portal']);
$app->router->post('/portal/password/change/n', ['controller'=>'ProfileController', 'action'=>'updatePassword', 'namespace'=>'portal']);

/**
 * School fee concern
 */
$app->router->get('/portal/school_fee:generate_invoice', ['controller'=>'SchoolFeeController', 'action'=>'generateInvoice']);
$app->router->post('/portal/school_fee:generate_invoice', ['controller'=>'SchoolFeeController', 'action'=>'showInvoice']);
$app->router->get('/portal/school_fee:print_receipt', ['controller'=>'SchoolFeeController', 'action'=>'printReceipt']);
$app->router->post('/portal/school_fee:print_receipt', ['controller'=>'SchoolFeeController', 'action'=>'showReceipt']);

/**
 * course registration controller
 */
$app->router->get('/portal/course:register', ['controller'=>'CourseRegistrationController', 'action'=>'viewCourses']);
$app->router->post('/portal/course:register', ['controller'=>'CourseRegistrationController', 'action'=>'storeCourses']);

/**
 * result check concern
 */
$app->router->get('/portal/result:check', ['controller'=>'ResultController', 'action'=>'viewResult']);
$app->router->post('/portal/result:check', ['controller'=>'ResultController', 'action'=>'showResult']);

/**
 * lecturer routes start here
 */

$app->router->get('/lecturer/profile', ['controller'=>'ProfileController', 'action'=>'viewProfile', 'namespace'=>'lecturer']);
$app->router->get('/lecturer/profile/edit', ['controller'=>'ProfileController', 'action'=>'editProfile', 'namespace'=>'lecturer']);
$app->router->post('/lecturer/profile/edit', ['controller'=>'ProfileController', 'action'=>'submitEditedProfile', 'namespace'=>'lecturer']);

$app->router->get('/lecturer/password/change', ['controller'=>'ProfileController', 'action'=>'changePassword', 'namespace'=>'lecturer']);
$app->router->post('/lecturer/password/change', ['controller'=>'ProfileController', 'action'=>'submitPassword', 'namespace'=>'lecturer']);
$app->router->post('/lecturer/password/change/n', ['controller'=>'ProfileController', 'action'=>'updatePassword', 'namespace'=>'lecturer']);

$app->router->get('/lecturer/result/upload', ['controller'=>'ResultController', 'action'=>'resultUpload', 'namespace'=>'lecturer']);
$app->router->post('/lecturer/result/upload', ['controller'=>'ResultController', 'action'=>'resultUpload', 'namespace'=>'lecturer']);
$app->router->get('/lecturer/result/view', ['controller'=>'ResultController', 'action'=>'resultView', 'namespace'=>'lecturer']);
$app->router->post('/lecturer/result/view', ['controller'=>'ResultController', 'action'=>'resultView', 'namespace'=>'lecturer']);

$app->router->post('/lecturer/result/upload/import:csv', ['controller'=>'ResultController', 'action'=>'csvHandler', 'namespace'=>'lecturer']);

/**
 * admin routes start here
 */
$app->router->get('/admin/student/list', ['controller'=>'StudentController', 'action'=>'viewStudentList', 'namespace'=>'admin']);
$app->router->post('/admin/student/list', ['controller'=>'StudentController', 'action'=>'viewStudentList', 'namespace'=>'admin']);

$app->router->get('/admin/edit/student', ['controller'=>'StudentController', 'action'=>'editStudent', 'namespace'=>'admin']);
$app->router->post('/admin/edit/student', ['controller'=>'StudentController', 'action'=>'submitEditStudent', 'namespace'=>'admin']);

$app->router->get('/admin/info/student', ['controller'=>'StudentController', 'action'=>'viewStudent', 'namespace'=>'admin']);
$app->router->get('/admin/id_card/student', ['controller'=>'StudentController', 'action'=>'showId', 'namespace'=>'admin']);

$app->router->get('/admin/remove/student', ['controller'=>'StudentController', 'action'=>'deleteStudent', 'namespace'=>'admin']);
$app->router->get('/admin/add/student', ['controller'=>'StudentController', 'action'=>'addStudent', 'namespace'=>'admin']);
$app->router->post('/admin/add/student', ['controller'=>'StudentController', 'action'=>'submitAddStudent', 'namespace'=>'admin']);

$app->router->get('/admin/add/lecturer', ['controller'=>'LecturerController', 'action'=>'addLecturer', 'namespace'=>'admin']);
$app->router->post('/admin/add/lecturer', ['controller'=>'LecturerController', 'action'=>'submitAddLecturer', 'namespace'=>'admin']);

/**
 * faculty
 */
$app->router->get('/admin/add/faculty', ['controller'=>'FacultyController', 'action'=>'showAddFaculty', 'namespace'=>'admin']);
$app->router->post('/admin/add/faculty', ['controller'=>'FacultyController', 'action'=>'submitAddFaculty', 'namespace'=>'admin']);

/**
 * department
 */
$app->router->get('/admin/add/department', ['controller'=>'DepartmentController', 'action'=>'showAddFaculty', 'namespace'=>'admin']);
$app->router->post('/admin/add/department', ['controller'=>'DepartmentController', 'action'=>'submitAddFaculty', 'namespace'=>'admin']);

$app->router->get('/admin/register_course/student', ['controller'=>'StudentController', 'action'=>'courseReg', 'namespace'=>'admin']);
$app->router->post('/admin/register_course/student', ['controller'=>'StudentController', 'action'=>'courseRegAdd', 'namespace'=>'admin']);

$app->router->get('/admin/session/view:all', ['controller'=>'SessionController', 'action'=>'viewSessions', 'namespace'=>'admin']);
$app->router->get('/admin/session/add', ['controller'=>'SessionController', 'action'=>'addSession', 'namespace'=>'admin']);
$app->router->post('/admin/session/add', ['controller'=>'SessionController', 'action'=>'addSession', 'namespace'=>'admin']);

$app->router->get('/admin/session/remove', ['controller'=>'SessionController', 'action'=>'deleteSession', 'namespace'=>'admin']);

$app->router->get('/admin/session/edit', ['controller'=>'SessionController', 'action'=>'editSession', 'namespace'=>'admin']);
$app->router->post('/admin/session/edit', ['controller'=>'SessionController', 'action'=>'editSession', 'namespace'=>'admin']);

$app->router->get('/admin/session/is:current', ['controller'=>'SessionController', 'action'=>'activateSession', 'namespace'=>'admin']);

$app->router->get('/admin/course/view:all', ['controller'=>'CourseController', 'action'=>'viewCourses', 'namespace'=>'admin']);
$app->router->get('/admin/course/add', ['controller'=>'CourseController', 'action'=>'addCourse', 'namespace'=>'admin']);
$app->router->post('/admin/course/add', ['controller'=>'CourseController', 'action'=>'addCourse', 'namespace'=>'admin']);

$app->router->get('/admin/course/remove', ['controller'=>'CourseController', 'action'=>'deleteCourse', 'namespace'=>'admin']);

$app->router->get('/admin/course/edit', ['controller'=>'CourseController', 'action'=>'editCourse', 'namespace'=>'admin']);
$app->router->post('/admin/course/edit', ['controller'=>'CourseController', 'action'=>'editCourse', 'namespace'=>'admin']);

$app->router->get('/admin/result/search', ['controller'=>'ResultController', 'action'=>'viewResult', 'namespace'=>'admin']);
$app->router->post('/admin/result/search', ['controller'=>'ResultController', 'action'=>'viewResult', 'namespace'=>'admin']);

$app->router->get('/admin/lecturer/list', ['controller'=>'LecturerController', 'action'=>'viewLecturers', 'namespace'=>'admin']);
$app->router->get('/admin/edit/lecturer', ['controller'=>'LecturerController', 'action'=>'editLecturer', 'namespace'=>'admin']);
$app->router->post('/admin/edit/lecturer', ['controller'=>'LecturerController', 'action'=>'editLecturer', 'namespace'=>'admin']);
$app->router->get('/admin/info/lecturer', ['controller'=>'LecturerController', 'action'=>'viewLecturer', 'namespace'=>'admin']);
$app->router->get('/admin/remove/lecturer', ['controller'=>'LecturerController', 'action'=>'deleteLecturer', 'namespace'=>'admin']);
$app->run();