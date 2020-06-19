<?php
/**
 * REST API Methods for tags.
 */
include_once './connector.php';

$connection = Connector::connect();

class Tag {

	public static function getOneById($id) {
		global $con;
		// Validate.
		if((int) $id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int) $id);
		// SQL
		$sql = "SELECT * FROM tag
			WHERE id = '{$id}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$tag['id'] 			    = $row['id'];
			$tag['name'] 			= $row['name'];
			$tag['author_id'] 	    = $row['author_id'];
			$tag['creation_date']	= $row['creation_date'];
			echo json_encode($tag);
		}else {
			return http_response_code(404);
		}
	}

	public static function getTags() {
		global $con;
		$sql = "SELECT * FROM tag";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$tags = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$tags[$i]['id'] 			= $row['id'];
				$tags[$i]['name'] 			= $row['name'];
				$tags[$i]['author_id'] 		= $row['author_id'];
				$tags[$i]['creation_date']	= $row['creation_date'];
				$i++;
			}
			echo json_encode($tags);
		}else {
			return http_response_code(404);
		}
	}

	public static function getTagsByAuthor($authorID) {
		global $con;
		if ((int) $authorID < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$authorID = mysqli_real_escape_string($con, (int) $authorID);
		// SQL
		$sql = "SELECT * FROM tag
			WHERE author_id = '{$authorID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$tags = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$tags[$i]['id'] 			= $row['id'];
				$tags[$i]['name'] 			= $row['name'];
				$tags[$i]['author_id'] 		= $row['author_id'];
				$tags[$i]['creation_date']	= $row['creation_date'];
				$i++;
			}
			echo json_encode($tags);
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
		if((int) $id < 1 || !isset($decodedParams['name']) || $decodedParams['name'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		//Retrieve Tag to be updated
		$sql = "SELECT * FROM tag
			WHERE id = '{$id}'";
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$tag['id'] 			    = $row['id'];
			$tag['name'] 			= $row['name'];
			$tag['author_id'] 	    = $row['author_id'];
			$tag['creation_date']	= $row['creation_date'];
		}else {
			return http_response_code(404);
		}
		$name = mysqli_real_escape_string($con, $decodedParams['name']);
		// SQL
		$sql = "UPDATE tag SET `name`='$name'
			WHERE id = '{$id}'";
		//Update
		if(mysqli_query($con, $sql)) {
			$sql = "SELECT * FROM tag
				WHERE id = '{$id}'";
			//retrieve updated tag
			if($result = mysqli_query($con, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$tag['id'] 			    = $row['id'];
				$tag['name'] 			= $row['name'];
				$tag['author_id'] 	    = $row['author_id'];
				$tag['creation_date']	= $row['creation_date'];
				echo json_encode($tag);
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
		if(!isset($decodedParams['name']) || $decodedParams['name'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$name 		= mysqli_real_escape_string($con, $decodedParams['name']);
		$authorID	= mysqli_real_escape_string($con, (int) $_SESSION['user_id']);
		// SQL
		$sql = "INSERT INTO `tag`(`name`,`author_id`)
			VALUES ('{$name}','{$authorID}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM tag WHERE id = '{$id}'";
			//retrieve created tag
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$tag['id'] 			    = $row['id'];
				$tag['name'] 			= $row['name'];
				$tag['author_id'] 	    = $row['author_id'];
				$tag['creation_date']	= $row['creation_date'];
				echo json_encode($tag);
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
		$sql = "DELETE FROM `tag` WHERE `id` ='{$id}'";
		//Delete
		if(mysqli_query($con, $sql)) {
			return http_response_code(201);
		}else {
			return http_response_code(404);
		}
	}
}
?>