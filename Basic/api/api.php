<?php 
/**
 * Auth.api.php - Processes Register, Log In, Reset Password
 * 
 * API requests sent here from respective pages
 * 
 **/

// Set Header
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../classes/Database.php'; // Database Class
$database = new Database();

require_once '../classes/Todo.php'; // Auth Class
$todo = new Todo( $database );

$out = array('error' => false);
/**
 * This will enable you receive data from VueJS as Objects instead of FormData
 * whether through POST or GET
 * If you're to use this, delete Lines 34 through 40 as they're not needed
 * 
 * Display the next line to receive object(s)
 * $data = json_decode(file_get_contents("php://input"));
 * 
 * Access the objects by "$data->form_name"
*/
$action = '';
if ( $_SERVER['REQUEST_METHOD'] === 'GET' ){
    $action = $_GET['action'];
}
elseif ( $_SERVER['REQUEST_METHOD'] === 'POST' ){
    $action = $_POST['action'];
}

// 2. Register
// if ( $action == 'register' ){
//     $email = strip_tags(stripslashes($_POST['email']));

//     // Validate Email Again
//     if ( filter_var($email, FILTER_VALIDATE_EMAIL) ){
//         $password = strip_tags($_POST['password']);
//         $password = password_hash($password, PASSWORD_DEFAULT);

//         $token = md5( uniqid(rand(), TRUE) . time() );

//         $Data = array(
//             'username' => strip_tags(stripslashes($_POST['username'])),
//             'email' => $email,
//             'password' => $password,
//             'token' => $token
//         );

//         $register = $auth->register( $Data );

//         if ( $register ){
//             if ( @$register['email'] == 'exists' ){ // Email Exists
//                 $out['error'] = true;
//                 $out['notice'] = 'exists'; // Notice
//                 $out['message'] = REGISTER_EMAIL_EXISTS; // Message
//             }
//             elseif ( ($register['auth'] == 'success') && ($register['mail'] == 'mail_sent') ){ // Account Created
//                 $out['error'] = false;
//                 $out['notice'] = 'success'; // Notice
//                 $out['message'] = REGISTER_SUCCESS_CODESENT; // Message
//                 $out['url'] = USER_LOGIN; // URL Redirection
//             }
//             elseif ( ($register['auth'] == 'success') && ($register['mail'] == 'mail_not_sent') ){ // Account Created
//                 $out['error'] = false;
//                 $out['notice'] = 'success'; // Notice
//                 $out['message'] = REGISTER_SUCCESS_CODENOTSENT . $register['token']; // Message
//                 $out['url'] = USER_LOGIN; // URL Redirection
//             }
//             else { // Account Not Created
//                 $out['error'] = true;
//                 $out['notice'] = 'fail'; // Notice
//                 $out['message'] = REGISTER_FAILED . json_encode($register); // Message
//             }
//         } else {
//             $out['error'] = true;
//             $out['message'] = json_encode($register);
//         }
//     } else {
//         $out['error'] = true;
//         $out['notice'] = 'fail'; // Notice
//         $out['message'] = REGISTER_EMAIL_INVALID; // Message
//     }

//     echo json_encode($out);
// }

if ($action == "add_todo"){
    $title = $_POST['title'];
    $description = $_POST['description'];

    $add_todo = $todo->add_todo( $title, $description );

    if($add_todo) {
        if($add_todo['status'] == 'success'){
            $out['error'] = false;
            $out['status'] = 'success';
            $out['message'] = "Todo successfully added!";
        }
        elseif($add_todo['status'] == 'failed'){
            $out['error'] = true;
            $out['message'] = "Todo not successfully added!";
        } 
        else {
            $out['error'] = true;
            $out['message'] = "Something went wrong.";
        }
    } 
    else {
        $out['error'] = true;
        $out['message'] = "Something went wrong: Did not receive any data!";
    }

    echo json_encode($out);
}

if ($action == 'get_todo') {

    $get_todo = $todo->get_todo();

    $out['rows'] = $get_todo;

    echo json_encode($out);
}

if ($action == "edit_todo"){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $edit_todo = $todo->edit_todo( $id, $title, $description );

    if($edit_todo) {
        if($edit_todo['status'] == 'success'){
            $out['error'] = false;
            $out['status'] = 'success';
            $out['message'] = "Todo successfully updated!";
        }
        elseif($edit_todo['status'] == 'failed'){
            $out['error'] = true;
            $out['message'] = "Todo not successfully updated!";
        } 
        else {
            $out['error'] = true;
            $out['message'] = "Something went wrong.";
        }
    } 
    else {
        $out['error'] = true;
        $out['message'] = "Something went wrong: Did not receive any data!";
    }

    echo json_encode($out);
}

if ($action == "delete_todo"){
    $id = $_POST['id'];

    $delete_todo = $todo->delete_todo( $id );

    if($delete_todo) {
        if($delete_todo['status'] == 'success'){
            $out['error'] = false;
            $out['status'] = 'success';
            $out['message'] = "Todo successfully deleted!";
        }
        elseif($delete_todo['status'] == 'failed'){
            $out['error'] = true;
            $out['message'] = "Todo not successfully deleted!";
        } 
        else {
            $out['error'] = true;
            $out['message'] = "Something went wrong.";
        }
    } 
    else {
        $out['error'] = true;
        $out['message'] = "Something went wrong: Did not receive any data!";
    }

    echo json_encode($out);
}

header("Content-type: application/json");
die();