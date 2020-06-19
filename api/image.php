<?php
/**
 * REST API Methods for images.
 */
include_once './connector.php';

$connection = Connector::connect();

class Image {

	public static function getOneById($id) {
		global $con;
		// Validate.
		if((int) $id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int) $id);
		// SQL
		$sql = "SELECT * FROM image
			WHERE id = '{$id}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$image['id'] 			= $row['id'];
			$image['url'] 			= $row['url'];
			$image['author_id'] 	= $row['author_id'];
			$image['creation_date']	= $row['creation_date'];
			echo json_encode($image);
		}else {
			return http_response_code(404);
		}
	}

	public static function getImages() {
		global $con;
		$sql = "SELECT * FROM image";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$images = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$images[$i]['id'] 				= $row['id'];
				$images[$i]['url'] 				= $row['url'];
				$images[$i]['author_id'] 		= $row['author_id'];
				$images[$i]['creation_date']	= $row['creation_date'];
				$i++;
			}
			echo json_encode($images);
		}else {
			return http_response_code(404);
		}
	}

	public static function getImagesByAuthor($authorID) {
		global $con;
		if ((int) $authorID < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$authorID = mysqli_real_escape_string($con, (int) $authorID);
		// SQL
		$sql = "SELECT * FROM image
			WHERE author_id = '{$authorID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$images = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$images[$i]['id'] 				= $row['id'];
				$images[$i]['url'] 				= $row['url'];
				$images[$i]['author_id'] 		= $row['author_id'];
				$images[$i]['creation_date']	= $row['creation_date'];
				$i++;
			}
			echo json_encode($images);
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
		if((int) $id < 1 || !isset($decodedParams['url']) || $decodedParams['url'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		//Retrieve Image to be updated
		$sql = "SELECT * FROM image
			WHERE id = '{$id}'";
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$image['id'] 			= $row['id'];
			$image['url'] 			= $row['url'];
			$image['author_id'] 	= $row['author_id'];
			$image['creation_date']	= $row['creation_date'];
		}else {
			return http_response_code(404);
		}
		$url = mysqli_real_escape_string($con, $decodedParams['url']);
		// SQL
		$sql = "UPDATE image SET `url`='$url'
			WHERE id = '{$id}'";
		//Update
		if(mysqli_query($con, $sql)) {
			$sql = "SELECT * FROM image
				WHERE id = '{$id}'";
			//retrieve updated image
			if($result = mysqli_query($con, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$image['id'] 			= $row['id'];
				$image['url'] 			= $row['url'];
				$image['author_id'] 	= $row['author_id'];
				$image['creation_date']	= $row['creation_date'];
				echo json_encode($image);
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
		if(!isset($decodedParams['url']) || $decodedParams['url'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$url 		= mysqli_real_escape_string($con, $decodedParams['url']);
		$authorID	= mysqli_real_escape_string($con, (int) $_SESSION['user_id']);
		// SQL
		$sql = "INSERT INTO `image`(`url`,`author_id`)
			VALUES ('{$url}','{$authorID}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM image WHERE id = '{$id}'";
			//retrieve created image
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$image['id'] 			= $row['id'];
				$image['url'] 			= $row['url'];
				$image['author_id'] 	= $row['author_id'];
				$image['creation_date']	= $row['creation_date'];
				echo json_encode($image);
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
		$sql = "DELETE FROM `image` WHERE `id` ='{$id}'";
		//Delete
		if(mysqli_query($con, $sql)) {
			return http_response_code(201);
		}else {
			return http_response_code(404);
		}
	}
}
?>