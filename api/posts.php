<?php
/**
 * REST API Methods for Posts.
 */
require './connector.php';

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
parse_str($_SERVER['QUERY_STRING'], $request);
$input = file_get_contents('php://input');
$decodedinput = json_decode($input,true);

// function based on HTTP method
switch ($method) {
  case 'GET':
		if(isset($request['id']) && !empty($request['id'])) {
			// Validate.
			if((int)$request['id'] < 1) {
				return http_response_code(400);
			}
			// Sanitize
			$id = mysqli_real_escape_string($con, (int)$request['id']);
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
		}elseif(isset($request['category']) && !empty($request['category'])) {
			// Validate.
			if($request['category'] === '') {
				return http_response_code(400);
			}
			// Sanitize
			$category = mysqli_real_escape_string($con, $request['category']);
			// SQL
			$sql = "SELECT * FROM posts WHERE category = '{$category}'";
			//create
			if($result = mysqli_query($con,$sql)) {
				$posts = [];
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
		}elseif(!isset($input) && empty($input)){
			$sql = "SELECT * FROM posts";
			if($result = mysqli_query($con,$sql)) {
				$posts = [];
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
		}else {
			http_response_code(404);
		}
		break;
  case 'PUT':
		if(!$_SESSION['user_id']) {
			return http_response_code(400);
		}
		if(isset($input) && !empty($input)) {
			// Validate.
			if((int)$decodedinput->id < 1 || $decodedinput->title === '') {
				return http_response_code(400);
			}
			// Sanitize
			$id 			= mysqli_real_escape_string($con, (int)$decodedinput->id);
			$title 		= mysqli_real_escape_string($con, $decodedinput->title);
			$text 		= mysqli_real_escape_string($con, $decodedinput->text);
			$category = mysqli_real_escape_string($con, $decodedinput->category);
			// SQL
			$sql = "UPDATE posts SET `title`='$title',`text`='$text', `category`='$category' WHERE id = '{$id}' LIMIT 1";
			//create
			if(mysqli_query($con,$sql)) {
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
					http_response_code(201);
				}
			}else {
				http_response_code(404);
			}
		}else {
			http_response_code(404);
		}
		break;
  case 'POST':
		if(!$_SESSION['user_id']) {
			return http_response_code(400);
		}
		if(isset($input) && !empty($input)) {
			// Validate.
			if((int)$decodedinput->id < 1 || $decodedinput->title === '') {
				return http_response_code(400);
			}
			// Sanitize
			$id 			= mysqli_real_escape_string($con, (int)$decodedinput->id);
			$title 		= mysqli_real_escape_string($con, $decodedinput->title);
			$text 		= mysqli_real_escape_string($con, $decodedinput->text);
			$category = mysqli_real_escape_string($con, $decodedinput->category);
			$author_id= mysqli_real_escape_string($con, (int)$_SESSION['user_id']);
			// SQL
			$sql = "INSERT INTO `posts`(`title`,`text`,`category`,`author_id`) VALUES ('{$title}','{$text}','{$category}','{$author_id}')";
			//create
			if(mysqli_query($con,$sql)) {
				http_response_code(201);
			}else {
				http_response_code(404);
			}
		}else {
			http_response_code(404);
		}
		break;
  case 'DELETE':
		if(!$_SESSION['user_id']) {
			return http_response_code(400);
		}
		if(isset($request['id']) && !empty($request['id'])) {
			// Validate.
			if((int)$request['id'] < 1) {
				return http_response_code(400);
			}
			// Sanitize
			$id = mysqli_real_escape_string($con, (int)$request['id']);
			// SQL
			$sql = "DELETE FROM `posts` WHERE `id` ='{$id}' LIMIT 1";
			//create
			if(mysqli_query($con,$sql)) {
				http_response_code(201);
			}else {
				http_response_code(404);
			}
		}else {
			http_response_code(404);
		}
		break;
}



?>