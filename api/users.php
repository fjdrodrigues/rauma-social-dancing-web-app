<?php
/**
 * REST API Methods for Users.
 */
require '../connector.php';

if(!$_SESSION['user_id']) {
	return http_response_code(400);
}

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
			if((int)$request->id < 1) {
				return http_response_code(400);
			}
			// Sanitize
			$id = mysqli_real_escape_string($con, (int)$request->id);
			// SQL
			$sql = "SELECT * FROM users WHERE id = '{$id}' LIMIT 1";
			//create
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$user['id'] 						= $row['id'];
				$user['username'] 			= $row['username'];
				$user['first_name']			= $row['first_name'];
				$user['last_name'] 			= $row['last_name'];
				$user['user_type'] 			= $row['user_type'];
				$user['birth_date']			= $row['birth_date'];
				$user['creation_date']	= $row['creation_date'];
				echo json_encode($user);
			}else {
				http_response_code(404);
			}
		}else {
			$users = [];
			$sql = "SELECT * FROM users";
			if($result = mysqli_query($con,$sql)) {
				$i = 0;
				while($row = mysqli_fetch_assoc($result)) {
					$users[$i]['id'] 						= $row['id'];
					$users[$i]['username'] 			= $row['username'];
					$users[$i]['first_name']		= $row['first_name'];
					$users[$i]['last_name'] 		= $row['last_name'];
					$users[$i]['user_type'] 		= $row['user_type'];
					$users[$i]['birth_date']		= $row['birth_date'];
					$users[$i]['creation_date']	= $row['creation_date'];
					$i++;
				}
				echo json_encode($users);
			}else {
				http_response_code(404);
			}
		}
		break;
  case 'PUT':
		if(isset($input) && !empty($input)) {
			// Validate.
			if((int)$decodedinput->id < 1 || $decodedinput->username === '' ||
				$decodedinput->password === '' || $decodedinput->first_name === '' ||
				$decodedinput->last_name === '' || $decodedinput->user_type === '' ||
				$decodedinput->birth_date === '') {
				return http_response_code(400);
			}
			// Sanitize
			$id 				= mysqli_real_escape_string($con, (int)$decodedinput->id);
			$username 	= mysqli_real_escape_string($con, $decodedinput->username);
			$password 	= mysqli_real_escape_string($con, $decodedinput->password);
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$first_name = mysqli_real_escape_string($con, $decodedinput->first_name);
			$last_name	= mysqli_real_escape_string($con, $decodedinput->last_name);
			$user_type	= mysqli_real_escape_string($con, $decodedinput->user_type);
			$birth_date = mysqli_real_escape_string($con, $decodedinput->birth_date);
			// SQL
			$sql = "UPDATE users SET `username`='$username', `password`='$hashedPassword', `first_name`='$first_name',
				`last_name`='$last_name',`user_type`='$user_type',`birth_date`='$birth_date' WHERE id = '{$id}' LIMIT 1";
			//create
			if(mysqli_query($con,$sql)) {
				http_response_code(204);
			}else {
				http_response_code(404);
			}
		}else {
			http_response_code(404);
		}
		break;
  case 'POST':
		if(isset($input) && !empty($input)) {
			// Validate.
			if((int)$decodedinput->id < 1 || $decodedinput->username === '' ||
				$decodedinput->password === '' || $decodedinput->first_name === '' ||
				$decodedinput->last_name === '' || $decodedinput->user_type === '' ||
				$decodedinput->birth_date === '') {
			// Sanitize
			$id 				= mysqli_real_escape_string($con, (int)$decodedinput->id);
			$username 	= mysqli_real_escape_string($con, $decodedinput->username);
			$password 	= mysqli_real_escape_string($con, $decodedinput->password);
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$first_name = mysqli_real_escape_string($con, $decodedinput->first_name);
			$last_name	= mysqli_real_escape_string($con, $decodedinput->last_name);
			$user_type	= mysqli_real_escape_string($con, $decodedinput->user_type);
			$birth_date = mysqli_real_escape_string($con, $decodedinput->birth_date);
			// SQL
			$sql = "INSERT INTO `users`(`username`,`password`,`first_name`,`last_name`,`user_type`,`birth_date`)
				VALUES ('{$username}','{$hashedPassword}','{$first_name}','{$last_name}','{$user_type}','{$birth_date}')";
			//create
			if(mysqli_query($con,$sql)) {
				http_response_code(201);
			}else {
				http_response_code(404);
		}else {
			http_response_code(404);
		}
		break;
  case 'DELETE':
		if(isset($input) && !empty($input)) {
			// Validate.
			if((int)$request->id < 1) {
				return http_response_code(400);
			}
			// Sanitize
			$id = mysqli_real_escape_string($con, (int)$request->id);
			// SQL
			$sql = "DELETE FROM `users` WHERE `id` ='{$id}' LIMIT 1";
			//create
			if(mysqli_query($con,$sql)) {
				http_response_code(201);
			}else {
				http_response_code(404);
		}else {
			http_response_code(404);
		}
		break;
}



?>