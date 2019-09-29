<?php
/**
 * REST API Methods for Logout.
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
		session_unset();
		session_destroy();
		if($_SESSION['user_id']) {
			$user = $_SESSION['user_id'];
			echo json_encode($user);
		}else {
			http_response_code(404);
		}
		break;
	default:
		http_response_code(404);
		break;
}

?>