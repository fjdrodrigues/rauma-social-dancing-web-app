<?php
/**
 * REST API Methods for Posts.
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
			if((int)$decodedinput->id < 1) {
				return http_response_code(400);
			}
			// Sanitize
			$id = mysqli_real_escape_string($con, (int)$request->id);
			// SQL
			$sql = "SELECT * FROM posts WHERE id = '{$id}' LIMIT 1";
			//create
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$post['id'] 						= $row['id'];
				$post['title'] 					= $row['title'];
				$post['text'] 					= $row['text'];
				$post['category'] 			= $row['category'];
				$post['author_id'] 			= $row['author_id'];
				$post['creation_date']	= $row['creation_date'];
				echo json_encode($post);
			}else {
				http_response_code(404);
			}
		}else {
			$posts = [];
			$sql = "SELECT * FROM posts";
			if($result = mysqli_query($con,$sql)) {
				$i = 0;
				while($row = mysqli_fetch_assoc($result)) {
					$posts[$i]['id'] 						= $row['id'];
					$posts[$i]['title'] 				= $row['title'];
					$posts[$i]['text'] 					= $row['text'];
					$posts[$i]['category'] 			= $row['category'];
					$posts[$i]['author_id'] 		= $row['author_id'];
					$posts[$i]['creation_date']	= $row['creation_date'];
					$i++;
				}
				echo json_encode($posts);
			}else {
				http_response_code(404);
			}
		}
		break;
  case 'PUT':
		if(isset($input) && !empty($input)) {
			// Validate.
			if((int)$decodedinput->id < 1 || $decodedinput->title === '') {
				return http_response_code(400);
			}
			// Sanitize
			$id 			= mysqli_real_escape_string($con, (int)$decodedinput->id);
			$title 		= mysqli_real_escape_string($con, $decodedinput->title);
			$text 		= mysqli_real_escape_string($con, $request->text);
			$category = mysqli_real_escape_string($con, $request->category);
			// SQL
			$sql = "UPDATE posts SET `title`='$title',`text`='$text', `category`='$category' WHERE id = '{$id}' LIMIT 1";
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
			if((int)$decodedinput->id < 1 || $decodedinput->title === '') {
				return http_response_code(400);
			}
			// Sanitize
			$id 			= mysqli_real_escape_string($con, (int)$decodedinput->id);
			$title 		= mysqli_real_escape_string($con, $decodedinput->title);
			$text 		= mysqli_real_escape_string($con, $request->text);
			$category = mysqli_real_escape_string($con, $request->category);
			$author_id= mysqli_real_escape_string($con, (int)currentAuthorId());
			// SQL
			$sql = "INSERT INTO `posts`(`title`,`text`,`category`,`author_id`) VALUES ('{$title}','{$text}','{$category}','{$author_id}')";
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
			if((int)$decodedinput->id < 1) {
				return http_response_code(400);
			}
			// Sanitize
			$id = mysqli_real_escape_string($con, (int)$decodedinput->id);
			// SQL
			$sql = "DELETE FROM `posts` WHERE `id` ='{$id}' LIMIT 1";
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