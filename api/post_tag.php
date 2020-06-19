<?php
/**
 * REST API Methods for post tags.
 */
include_once './connector.php';

$connection = Connector::connect();

class PostTag {

	public static function getOneById($id) {
		global $con;
		// Validate.
		if((int)$id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		// SQL
		$sql = "SELECT * FROM post_tag
			WHERE id = '{$id}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$postTag['id'] 			= $row['id'];
			$postTag['post_id']   = $row['post_id'];
			$postTag['tag_id'] 	    = $row['tag_id'];
			$postTag['creation_date']	= $row['creation_date'];
			echo json_encode($postTag);
		}else {
			return http_response_code(404);
		}
	}

	public static function getPostTags() {
		global $con;
		// SQL
		$sql = "SELECT * FROM post_tag";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$postTags = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$postTags[$i]['id'] 				= $row['id'];
				$postTags[$i]['post_id'] 		= $row['post_id'];
				$postTags[$i]['tag_id'] 		= $row['tag_id'];
				$postTags[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($postTags);
		}else {
			return http_response_code(404);
		}
	}

	public static function getPostsForTag($tagID) {
		global $con;
		// Validate.
        if((int)$tagID < 1) {
            return http_response_code(400);
        }
        // Sanitize
        $category = mysqli_real_escape_string($con, $tagID);
        // SQL
        $sql = "SELECT * FROM post_tag
            WHERE tag_id = '{$tagID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$postTags = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$postTags[$i]['id'] 				= $row['id'];
				$postTags[$i]['post_id'] 	    = $row['post_id'];
				$postTags[$i]['tag_id'] 		= $row['tag_id'];
				$postTags[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($postTags);
		}else {
			return http_response_code(404);
		}
	}

	public static function getTagsForPost($postID) {
		global $con;
		// Validate.
        if((int)$postID < 1) {
            return http_response_code(400);
        }
        // Sanitize
        $category = mysqli_real_escape_string($con, $postID);
        // SQL
        $sql = "SELECT * FROM post_tag
            WHERE post_id = '{$postID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$postTags = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$postTags[$i]['id'] 				= $row['id'];
				$postTags[$i]['post_id'] 	    = $row['post_id'];
				$postTags[$i]['tag_id'] 		= $row['tag_id'];
				$postTags[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($postTags);
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
        if((int)$id < 1 || 
            !isset($decodedParams['postID']) || $decodedParams['postID'] === '' ||
            !isset($decodedParams['tagID']) || $decodedParams['tagID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		//Retrieve post tag to be updated
		$sql = "SELECT * FROM post_tag
			WHERE id = '{$id}'";
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$postTag['id'] 			= $row['id'];
			$postTag['post_id'] 	= $row['post_id'];
			$postTag['tag_id'] 	    = $row['tag_id'];
			$postTag['creation_date'] = $row['creation_date'];
		}else {
			return http_response_code(404);
		}
		$postID = mysqli_real_escape_string($con, $decodedParams['postID']);
		$tagID	= mysqli_real_escape_string($con, $decodedParams['tagID']);
		// SQL
		$sql = "UPDATE post_tag
            SET `post_id`='$postID',`tag_id`='$tagID'
            WHERE id = '{$id}'";
		//Update
		if(mysqli_query($con, $sql)) {
			$sql = "SELECT * FROM post_tag WHERE id = '{$id}'";
			//retrieve updated post tag
			if($result = mysqli_query($con, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$postTag['id'] 			= $row['id'];
				$postTag['post_id'] 	= $row['post_id'];
				$postTag['tag_id'] 	    = $row['tag_id'];
				$postTag['creation_date']	= $row['creation_date'];
				echo json_encode($postTag);
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
        if(!isset($decodedParams['postID']) || $decodedParams['postID'] === '' ||
            !isset($decodedParams['tagID']) || $decodedParams['tagID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$postID = mysqli_real_escape_string($con, $decodedParams['postID']);
		$tagID	= isset($decodedParams['tagID']) ?
			mysqli_real_escape_string($con, $decodedParams['tagID']) : "";
		// SQL
		$sql = "INSERT INTO `post_tag`(`post_id`,`tag_id`)
		VALUES ('{$postID}','{$tagID}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM post_tag WHERE id = '{$id}'";
			//retrieve created post tag
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$postTag['id'] 			= $row['id'];
				$postTag['post_id'] 	= $row['post_id'];
				$postTag['tag_id'] 	    = $row['tag_id'];
				$postTag['creation_date'] = $row['creation_date'];
				echo json_encode($postTag);
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
		if((int)$id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		// SQL
		$sql = "DELETE FROM `post_tag` WHERE `id` ='{$id}'";
		//Delete
		if(mysqli_query($con, $sql)) {
			return http_response_code(201);
		}else {
			return http_response_code(404);
		}
	}
}