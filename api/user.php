
<?php
/**
 * REST API Methods for Users.
 */
include_once './connector.php';

$con = Connector::connect();

class User {

	public static function userExists($username) {
		global $con;
		// Validate.
		if($username == "") {
			return http_response_code(400);
		}
		// Sanitize
		$username = mysqli_real_escape_string($con, $username);
		// SQL
		$sql = "SELECT * FROM user
			WHERE username = '{$username}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			return true;
		} else {
			return false;
		}
	}

	public static function getUserForAuthentication($username) {
		global $con;
		// Validate.
		if($username == "") {
			return null;
		}
		// Sanitize
		$username = mysqli_real_escape_string($con, $username);
		// SQL
		$sql = "SELECT * FROM user
			WHERE username = '{$username}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$user['id'] 			= $row['id'];
			$user['username'] 		= $row['username'];
			$user['password'] 		= $row['password'];
			$user['first_name']		= $row['first_name'];
			$user['last_name'] 		= $row['last_name'];
			$user['user_type'] 		= $row['user_type'];
			$user['birth_date']		= $row['birth_date'];
			$user['creation_date']	= $row['creation_date'];
			return $user;
		}else {
			return null;
		}
	}

	public static function update($params) {
		global $con;
		$id = $params[0];
		$decodedParams = json_decode($params[1], true);
		if (!Authentication::verifyToken($decodedParams)) {
			return http_response_code(401);
		}
		// Validate.
		if(!isset($decodedParams['username']) || $decodedParams['username'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		//Retrieve User to be updated
		$sql = "SELECT * FROM user WHERE id = '{$id}'";
		//get
		if($result = mysqli_query($con,$sql)) {
			$row = mysqli_fetch_assoc($result);
			$user['id'] 			= $row['id'];
			$user['username'] 		= $row['username'];
			$user['password']		= $row['password'];
			$user['first_name']		= $row['first_name'];
			$user['last_name'] 		= $row['last_name'];
			$user['user_type'] 		= $row['user_type'];
			$user['birth_date']		= $row['birth_date'];
			$user['creation_date']	= $row['creation_date'];
			$user['last_updated_by']= $row['last_updated_by'];
			$user['last_update']	= $row['last_update'];
		}else {
			return http_response_code(404);
		}
		// Sanitize
		$username 		= isset($decodedParams['username']) ?
			mysqli_real_escape_string($con, $decodedParams['username']) :
			$user['username'];
		$hashedPassword = isset($decodedParams['password']) ?
		password_hash(mysqli_real_escape_string($con, $decodedParams['password']), PASSWORD_DEFAULT) :
			$user['password'];
		$firstName 	= isset($decodedParams['firstName']) ?
			mysqli_real_escape_string($con, $decodedParams['firstName']) :
			$user['first_name'];
		$lastName		= isset($decodedParams['lastName']) ?
			mysqli_real_escape_string($con, $decodedParams['lastName']) :
			$user['last_name'];
		$userType		= isset($decodedParams['userType']) ?
			mysqli_real_escape_string($con, $decodedParams['userType']) :
			$user['user_type'];
		$birthDate 	= isset($decodedParams['birthDate']) ?
			date("Y-m-d", strtotime(mysqli_real_escape_string($con, $decodedParams['birthDate']))) :
			$user['birth_date'];
		$lastUpdatedBy= mysqli_real_escape_string($con, (int)$_SESSION['user_id']);
		$lastUpdate 	= mysqli_real_escape_string($con, time());
		// SQL
		$sql = "UPDATE user SET `username`='$username',`password`='$hashedPassword',
		`first_name`='$firstName',`last_name`='$lastName',`user_type`='$userType',
		`birth_date`='$birthDate',`last_updated_by`='$lastUpdatedBy',
		`last_update`='$lastUpdate' WHERE id = '{$id}'";
		//create
		if(mysqli_query($con,$sql)) {
			$sql = "SELECT * FROM user WHERE id = '{$id}'";
			//get
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$user['id'] 			= $row['id'];
				$user['username'] 		= $row['username'];
				$user['first_name']		= $row['first_name'];
				$user['last_name'] 		= $row['last_name'];
				$user['user_type'] 		= $row['user_type'];
				$user['birth_date']		= $row['birth_date'];
				$user['creation_date']	= $row['creation_date'];
				$user['last_updated_by']= $row['last_updated_by'];
				$user['last_update']	= $row['last_update'];
				echo json_encode($user);
			}else {
				return http_response_code(404);
			}
		}else {
			return http_response_code(404);
		}
	}

	public static function create($params) {
		global $con;
		$decodedParams = json_decode($params, true);
		// Validate.
		if(!isset($decodedParams['username']) || $decodedParams['username'] === '' ||
			!isset($decodedParams['password']) || $decodedParams['password'] === '' ||
			!isset($decodedParams['firstName']) || $decodedParams['firstName'] === '' ||
			!isset($decodedParams['lastName']) || $decodedParams['lastName'] === '' ||
			!isset($decodedParams['userType']) ||
			($decodedParams['userType'] != 'admin' && $decodedParams['userType'] != 'user') ||
			!isset($decodedParams['birthDate']) || $decodedParams['birthDate'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$username 		= mysqli_real_escape_string($con, $decodedParams['username']);
		$password 		= mysqli_real_escape_string($con, $decodedParams['password']);
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$firstName 	= mysqli_real_escape_string($con, $decodedParams['firstName']);
		$lastName		= mysqli_real_escape_string($con, $decodedParams['lastName']);
		$userType		= mysqli_real_escape_string($con, $decodedParams['userType']);
		$birthDate 	= date("Y-m-d", strtotime(mysqli_real_escape_string($con, $decodedParams['birthDate'])));
		// SQL
		$sql = "INSERT INTO `user`(`username`,`password`,`first_name`,`last_name`,`user_type`,`birth_date`)
			VALUES ('{$username}','{$hashedPassword}','{$firstName}','{$lastName}','{$userType}','{$birthDate}')";
		//create
		if(mysqli_query($con,$sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM user WHERE id = '{$id}'";
			//get
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$user['id'] 			= $row['id'];
				$user['username'] 		= $row['username'];
				$user['first_name']		= $row['first_name'];
				$user['last_name'] 		= $row['last_name'];
				$user['user_type'] 		= $row['user_type'];
				$user['birth_date']		= $row['birth_date'];
				$user['creation_date']	= $row['creation_date'];
				echo json_encode($user);
			}else {
				return http_response_code(404);
			}
		}else {
			return http_response_code(404);
		}
	}

	public static function delete($params) {
		global $con;
		$id = $params[0];
		$decodedParams = json_decode($params[1], true);
		if (!Authentication::verifyToken($decodedParams)) {
			return http_response_code(401);
		}
		// Validate.
		if((int)$id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		// SQL
		$sql = "DELETE FROM `user` WHERE `id` ='{$id}'";
		//Delete
		if(mysqli_query($con, $sql)) {
			return http_response_code(201);
		}else {
			return http_response_code(404);
		}
	}
}
/*
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
		if(isset($request['id'])) {
			// Validate.
			if((int)$request->id < 1) {
				return http_response_code(400);
			}
			// Sanitize
			$id = mysqli_real_escape_string($con, (int)$request->id);
			// SQL
			$sql = "SELECT * FROM users WHERE id = '{$id}'";
			//get
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$user['id'] 			= $row['id'];
				$user['username'] 		= $row['username'];
				$user['first_name']		= $row['first_name'];
				$user['last_name'] 		= $row['last_name'];
				$user['user_type'] 		= $row['user_type'];
				$user['birth_date']		= $row['birth_date'];
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
					$users[$i]['id'] 			= $row['id'];
					$users[$i]['username'] 		= $row['username'];
					$users[$i]['first_name']	= $row['first_name'];
					$users[$i]['last_name'] 	= $row['last_name'];
					$users[$i]['user_type'] 	= $row['user_type'];
					$users[$i]['birth_date']	= $row['birth_date'];
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
			$id 			= mysqli_real_escape_string($con, (int)$decodedinput->id);
			$username 		= mysqli_real_escape_string($con, $decodedinput->username);
			$password 		= mysqli_real_escape_string($con, $decodedinput->password);
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$first_name 	= mysqli_real_escape_string($con, $decodedinput->first_name);
			$last_name		= mysqli_real_escape_string($con, $decodedinput->last_name);
			$user_type		= mysqli_real_escape_string($con, $decodedinput->user_type);
			$birth_date 	= mysqli_real_escape_string($con, $decodedinput->birth_date);
			// SQL
			$sql = "UPDATE users SET `username`='$username', `password`='$hashedPassword', `first_name`='$first_name',
				`last_name`='$last_name',`user_type`='$user_type',`birth_date`='$birth_date' WHERE id = '{$id}'";
			//update
			if(mysqli_query($con,$sql)) {
				$sql = "SELECT * FROM users WHERE id = '{$id}'";
				//get
				if($result = mysqli_query($con,$sql)) {
					$row = mysqli_fetch_assoc($result);
					$user['id'] 			= $row['id'];
					$user['username'] 		= $row['username'];
					$user['first_name']		= $row['first_name'];
					$user['last_name'] 		= $row['last_name'];
					$user['user_type'] 		= $row['user_type'];
					$user['birth_date']		= $row['birth_date'];
					$user['creation_date']	= $row['creation_date'];
					echo json_encode($user);
				}else {
					http_response_code(404);
				}
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
			$id 			= mysqli_real_escape_string($con, (int)$decodedinput->id);
			$username 		= mysqli_real_escape_string($con, $decodedinput->username);
			$password 		= mysqli_real_escape_string($con, $decodedinput->password);
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$first_name 	= mysqli_real_escape_string($con, $decodedinput->first_name);
			$last_name		= mysqli_real_escape_string($con, $decodedinput->last_name);
			$user_type		= mysqli_real_escape_string($con, $decodedinput->user_type);
			$birth_date 	= mysqli_real_escape_string($con, $decodedinput->birth_date);
			// SQL
			$sql = "INSERT INTO `users`(`username`,`password`,`first_name`,`last_name`,`user_type`,`birth_date`)
				VALUES ('{$username}','{$hashedPassword}','{$first_name}','{$last_name}','{$user_type}','{$birth_date}')";
			//create
			if(mysqli_query($con,$sql)) {
				$id = mysqli_insert_id($con);
				$sql = "SELECT * FROM users WHERE id = '{$id}'";
				//get
				if($result = mysqli_query($con,$sql)) {
					$row = mysqli_fetch_assoc($result);
					$user['id'] 			= $row['id'];
					$user['username'] 		= $row['username'];
					$user['first_name']		= $row['first_name'];
					$user['last_name'] 		= $row['last_name'];
					$user['user_type'] 		= $row['user_type'];
					$user['birth_date']		= $row['birth_date'];
					$user['creation_date']	= $row['creation_date'];
					echo json_encode($user);
				}else {
					http_response_code(404);
				}
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
			$sql = "DELETE FROM `users` WHERE `id` ='{$id}'";
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
*/
?>