<?php
/**
 * REST API Methods for Posts.
 */
include_once './connector.php';

$con = Connector::connect();

class Post {

	public static function getOneById($id) {
		global $con;
		// Validate.
		if((int) $id < 1) {
			return http_response_code(400);
		}
		
		// Sanitize
		$id = mysqli_real_escape_string($con, (int) $id);
		// SQL
		$sql = "SELECT * FROM posts WHERE id = '{$id}'";
		//create
		if($result = mysqli_query($con,$sql)) {
			$row = mysqli_fetch_assoc($result);
			$post['id'] 			= $row['id'];
			$post['title'] 			= $row['title'];
			$post['text'] 			= $row['text'];
			$post['category'] 		= $row['category'];
			$post['author_id'] 		= $row['author_id'];
			$post['creation_date']	= $row['creation_date'];
			echo json_encode($post);
		}else {
			http_response_code(404);
		}
	}

	public static function getPosts($category) {
		global $con;
		if ($category != null) {
			// Validate.
			if(!is_string($category)) {
				return http_response_code(400);
			}
			// Sanitize
			$category = mysqli_real_escape_string($con, $category);
			// SQL
			$sql = "SELECT * FROM post
				WHERE category = '{$category}'";
		} else {
			// SQL
			$sql = "SELECT * FROM post";
		}
		//Query
		if($result = mysqli_query($con, $sql)) {
			$posts = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$posts[$i]['id'] 				= $row['id'];
				$posts[$i]['title'] 			= $row['title'];
				$posts[$i]['text'] 				= $row['text'];
				$posts[$i]['category'] 			= $row['category'];
				$posts[$i]['author_id'] 		= $row['author_id'];
				$posts[$i]['creation_date']		= $row['creation_date'];
				$posts[$i]['last_updated_by']	= $row['last_updated_by'];
				$posts[$i]['last_update']		= $row['last_update'];
				$i++;
			}
			echo json_encode($posts);
		}else {
			return http_response_code(404);
		}
	}

	public static function getPastPosts($category) {
		global $con;
		if ($category != null) {
			// Validate.
			if(!is_string($category)) {
				return http_response_code(400);
			}
			// Sanitize
			$category = mysqli_real_escape_string($con, $category);
			// SQL
			$sql = "SELECT * FROM post
				WHERE end_date < CURDATE() AND category = '{$category}'";
		} else {
			// SQL
			$sql = "SELECT * FROM post
				WHERE end_date < CURDATE()";
		}
		//Query
		if($result = mysqli_query($con, $sql)) {
			$posts = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$posts[$i]['id'] 				= $row['id'];
				$posts[$i]['title'] 			= $row['title'];
				$posts[$i]['text'] 				= $row['text'];
				$posts[$i]['category'] 			= $row['category'];
				$posts[$i]['author_id'] 		= $row['author_id'];
				$posts[$i]['creation_date']		= $row['creation_date'];
				$posts[$i]['last_updated_by']	= $row['last_updated_by'];
				$posts[$i]['last_update']		= $row['last_update'];
				$i++;
			}
			echo json_encode($posts);
		}else {
			return http_response_code(404);
		}
	}

	public static function getCurrentPosts($category) {
		global $con;
		if ($category != null) {
			// Validate.
			if(!is_string($category)) {
				return http_response_code(400);
			}
			// Sanitize
			$category = mysqli_real_escape_string($con, $category);
			// SQL
			$sql = "SELECT * FROM post
				WHERE start_date <= CURDATE() AND end_date >= CURDATE() AND category = '{$category}'";	
		} else {
			// SQL
			$sql = "SELECT * FROM post
				WHERE start_date <= CURDATE() AND end_date >= CURDATE()";
		}
		//Query
		if($result = mysqli_query($con, $sql)) {
			$posts = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$posts[$i]['id'] 				= $row['id'];
				$posts[$i]['title'] 			= $row['title'];
				$posts[$i]['text'] 				= $row['text'];
				$posts[$i]['category'] 			= $row['category'];
				$posts[$i]['author_id'] 		= $row['author_id'];
				$posts[$i]['creation_date']		= $row['creation_date'];
				$posts[$i]['last_updated_by']	= $row['last_updated_by'];
				$posts[$i]['last_update']		= $row['last_update'];
				$i++;
			}
			echo json_encode($posts);
		}else {
			return http_response_code(404);
		}
	}

	public static function getFuturePosts($category) {
		global $con;
		if ($category != null) {
			// Validate.
			if(!is_string($category)) {
				return http_response_code(400);
			}
			// Sanitize
			$category = mysqli_real_escape_string($con, $category);
			// SQL
			$sql = "SELECT * FROM post
				WHERE start_date > CURDATE() AND category = '{$category}'";
		} else {
			// SQL
			$sql = "SELECT * FROM post
				WHERE start_date > CURDATE()";
		}
		//Query
		if($result = mysqli_query($con, $sql)) {
			$posts = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$posts[$i]['id'] 				= $row['id'];
				$posts[$i]['title'] 			= $row['title'];
				$posts[$i]['text'] 				= $row['text'];
				$posts[$i]['category'] 			= $row['category'];
				$posts[$i]['author_id'] 		= $row['author_id'];
				$posts[$i]['creation_date']		= $row['creation_date'];
				$posts[$i]['last_updated_by']	= $row['last_updated_by'];
				$posts[$i]['last_update']		= $row['last_update'];
				$i++;
			}
			echo json_encode($posts);
		}else {
			return http_response_code(404);
		}
	}

	public static function update($params) {
		global $con;
		$id = $params[0];
		$decodedParams = json_decode($params[1], true);
		//Check Authentication
		if (!Authentication::verifyToken($decodedParams)) {
			return http_response_code(401);
		}
		//User is present
		if(!$_SESSION['user_id']) {
			return http_response_code(400);
		}
		// Validate
		if((int) $id < 1 || !isset($decodedParams['title']) || $decodedParams['title'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int) $id);
		//Retrieve Post to be updated
		$sql = "SELECT * FROM post
			WHERE id = '{$id}'";
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$post['id'] 			= $row['id'];
			$post['title'] 			= $row['title'];
			$post['text'] 			= $row['text'];
			$post['category'] 		= $row['category'];
			$post['author_id'] 		= $row['author_id'];
			$post['creation_date']	= $row['creation_date'];
			$post['last_updated_by']= $row['last_updated_by'];
			$post['last_update']	= $row['last_update'];
		}else {
			return http_response_code(404);
		}
		$title 			= mysqli_real_escape_string($con, $decodedParams['title']);
		$text	= isset($decodedParams['text']) ?
			mysqli_real_escape_string($con, $decodedParams['text']) :
			$post['text'];
		$category 		= isset($decodedParams['category']) ?
			mysqli_real_escape_string($con, $decodedParams['category']) :
			$post['category'];
		$lastUpdatedBy = mysqli_real_escape_string($con, (int) $_SESSION['user_id']);
		$lastUpdate = mysqli_real_escape_string($con, time());
		// SQL
		$sql = "UPDATE post SET `title`='$title',`text`='$text',
			`category`='$category',`last_updated_by`='$lastUpdatedBy',
			`last_update`='$lastUpdate' WHERE id = '{$id}'";
		//Update
		if(mysqli_query($con, $sql)) {
			$sql = "SELECT * FROM post WHERE id = '{$id}'";
			//retrieve updated post
			if($result = mysqli_query($con, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$post['id'] 			= $row['id'];
				$post['title'] 			= $row['title'];
				$post['text'] 			= $row['text'];
				$post['category'] 		= $row['category'];
				$post['author_id'] 		= $row['author_id'];
				$post['creation_date']	= $row['creation_date'];
				$post['last_updated_by']= $row['last_updated_by'];
				$post['last_update']	= $row['last_update'];
				echo json_encode($post);
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
		//Check Authentication
		if (!Authentication::verifyToken($decodedParams)) {
			return http_response_code(401);
		}
		//User is present
		if(!$_SESSION['user_id']) {
			return http_response_code(400);
		}
		// Validate.
		if(!isset($decodedParams['title']) || $decodedParams['title'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$title 			= mysqli_real_escape_string($con, $decodedParams['title']);
		$text	= isset($decodedParams['text']) ?
			mysqli_real_escape_string($con, $decodedParams['text']) : "";
		$category 		= isset($decodedParams['category']) ?
			mysqli_real_escape_string($con, $decodedParams['category']) : "";
		$authorID		= mysqli_real_escape_string($con, (int) $_SESSION['user_id']);
		$lastUpdatedBy = mysqli_real_escape_string($con, (int) $_SESSION['user_id']);
		// SQL
		$sql = "INSERT INTO `post`(`title`,`text`,`category`,`author_id`,`last_updated_by`)
		VALUES ('{$title}','{$text}','{$category}','{$authorID}','{$lastUpdatedBy}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM post WHERE id = '{$id}'";
			//retrieve created post
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$post['id'] 			= $row['id'];
				$post['title'] 			= $row['title'];
				$post['text'] 			= $row['text'];
				$post['author_id'] 		= $row['author_id'];
				$post['creation_date']	= $row['creation_date'];
				$post['last_updated_by']= $row['last_updated_by'];
				$post['last_update']	= $row['last_update'];
				echo json_encode($post);
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
		//Check Authentication
		if (!Authentication::verifyToken($decodedParams)) {
			return http_response_code(401);
		}
		//User is present
		if(!$_SESSION['user_id']) {
			return http_response_code(400);
		}
		// Validate.
		if((int) $id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int) $id);
		// SQL
		$sql = "DELETE FROM `post` WHERE `id` ='{$id}'";
		//Delete
		if(mysqli_query($con, $sql)) {
			return http_response_code(201);
		}else {
			return http_response_code(404);
		}
	}
}
?>