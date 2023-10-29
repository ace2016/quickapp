<?php
/**
 * Auth.class.php -- Authentication Class
 */

ini_set( 'display_errors', 1 );

class Todo
{
    private $db;

    // database connection & constants
    public function __construct( Database $db )
    {
        ob_start();

		$this->db = $db;
    }

    // close database connection
    function __destruct()
    {
        $this->db = null;
        unset($this->db);
        ob_end_flush();
    }

    public function add_todo($title, $description){
        $resData = array();

        $insert = $this->db->query("INSERT INTO lists (title, description, date_added) VALUES ('$title', '$description', NOW())");

        if($insert){
            $resData['status'] = 'success';
        } else {
            $resData['status'] = 'failed';
        }

        return $resData;
        
    }

    public function get_todo() {
        $resData = [];

        $fetch = $this->db->query("SELECT * from lists");

        $resData = $fetch->fetchAll();

        unset($fetch);
        return $resData;

    }

    public function edit_todo($id, $title, $description){
        $resData = array();

        $update = $this->db->query("UPDATE lists SET title = '$title', description = '$description' WHERE id = '$id'");

        if($update){
            $resData['status'] = 'success';
        } else {
            $resData['status'] = 'failed';
        }

        return $resData;
        
    }

    public function delete_todo($id){
        $resData = array();

        $update = $this->db->query("DELETE FROM lists WHERE id = '$id'");

        if($update){
            $resData['status'] = 'success';
        } else {
            $resData['status'] = 'failed';
        }

        return $resData;
        
    }

    // 2. Register
    // public function register( array $data )
    // {
    //     $output = array();

	// 	$check = $this->db->query( "SELECT email FROM ". TBL_USR ." WHERE email=?", [$data['email']] );

    //     try {
	// 		if ( $check->rowCount() > 0 ){ // Email Exists
	// 			$output['email'] = 'exists';
	// 		}
	// 		else {
	// 			$insert_data = " username=?";
	// 			$insert_data .= ", password=?";
	// 			$insert_data .= ", email=?";
	// 			$insert_data .= ", created_at=NOW()";

	// 			$params = [
	// 				strtolower($data['username']),
	// 				$data['password'],
	// 				$data['email']
	// 			];
	// 			$insert = $this->db->query( "INSERT INTO ". TBL_USR. " SET ". $insert_data, $params );

	// 			if ( $insert ){ // Account Created
	// 				$user_id = $this->db->getConnection()->lastInsertId();

	// 				$auth = $this->db->query( "INSERT INTO ". TBL_UTOKEN ." (uid, token, reason) VALUES (?, ?, ?)", [$user_id, $data['token'], "register"] );
	// 				if ( $auth ){
	// 					$output['auth'] = 'success';

	// 					// send verification email
	// 					//$send_mail = SendMail( 'Verification Code', $data['email'], NoReplyEmail, VerficationAuthToken( CompanyName, $data['token'], CompanyTeamName ) );
						
	// 					//if ( $send_mail == 'sent' ){
	// 						//$output['mail'] = 'mail_sent';
	// 					//} else {
	// 						//$output['mail'] = 'mail_not_sent';
	// 						//$output['token'] = $data['token'];
	// 					//}
	// 					$output['mail'] = 'mail_not_sent';
	// 					$output['token'] = $data['token'];
	// 				}
	// 			} else { // Account Not Created
	// 				$output = $this->db->getConnection()->errorInfo();
	// 			}
	// 		}

    //     }
    //     catch(PDOException $e){
    //         echo $e->getMessage();
    //     }

	// 	unset($check);
    //     return $output;
    // }

}