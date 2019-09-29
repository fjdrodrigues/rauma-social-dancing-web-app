<?php
/**
 * REST API Methods for Login.
 */
require '../connector.php';

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = file_get_contents('php://input');
$decodedinput = json_decode($input,true);

// function based on HTTP method
switch ($method) {
  case 'GET':
		if(isset($input) && !empty($input)) {
			// Validate.
			if($decodedinput->username === '' || $decodeinput->password === '') {
				return http_response_code(400);
			}
			// Sanitize
			$username 		  = mysqli_real_escape_string($con, $decodedinput->username);
			$hashedPassword = password_hash($request->password, PASSWORD_DEFAULT);
			// SQL
			$sql = "SELECT * FROM users WHERE username = '{$username}' LIMIT 1";
			//create
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				if(password_verify($user['password'], $hashedPassword)) {
					$user['id'] 				= $row['id'];
					$user['username'] 	= $row['username'];
					$user['first_name']	= $row['first_name'];
					$user['last_name'] 	= $row['last_name'];
					$user['user_type'] 	= $row['user_type'];
					session_start();
					$_SESSION['user_id'] = $user['id'];
					echo json_encode($user);
				}
			}else {
				http_response_code(404);
			}
		}else {
			http_response_code(404);
		}
		break;
	default:
		http_response_code(404);
		break;
}

?>