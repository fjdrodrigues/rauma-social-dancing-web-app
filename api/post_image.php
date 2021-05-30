<?php
/**
 * REST API Methods for post images.
 */
include_once './connector.php';




class PostImage {

	public static function getOneById($id) {
		global $con;
		// Validate.
		if((int)$id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		// SQL
		$sql = "SELECT * FROM post_image
			WHERE id = '{$id}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$postImage['id'] 			= $row['id'];
			$postImage['post_id']   = $row['post_id'];
			$postImage['image_id'] 	    = $row['image_id'];
			$postImage['creation_date']	= $row['creation_date'];
			echo json_encode($postImage);
		}else {
			return http_response_code(404);
		}
	}

	public static function getPostImages() {
		global $con;
		// SQL
		$sql = "SELECT * FROM post_image";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$postImages = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$postImages[$i]['id'] 				= $row['id'];
				$postImages[$i]['post_id'] 		= $row['post_id'];
				$postImages[$i]['image_id'] 		= $row['image_id'];
				$postImages[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($postImages);
		}else {
			return http_response_code(404);
		}
	}

	public static function getPostsForImage($imageID) {
		global $con;
		// Validate.
        if((int)$imageID < 1) {
            return http_response_code(400);
        }
        // Sanitize
        $category = mysqli_real_escape_string($con, $imageID);
        // SQL
        $sql = "SELECT * FROM post_image
            WHERE image_id = '{$imageID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$postImages = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$postImages[$i]['id'] 				= $row['id'];
				$postImages[$i]['post_id'] 	    = $row['post_id'];
				$postImages[$i]['image_id'] 		= $row['image_id'];
				$postImages[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($postImages);
		}else {
			return http_response_code(404);
		}
	}

	public static function getImagesForPost($postID) {
		global $con;
		// Validate.
        if((int)$postID < 1) {
            return http_response_code(400);
        }
        // Sanitize
        $category = mysqli_real_escape_string($con, $postID);
        // SQL
        $sql = "SELECT * FROM post_image
            WHERE post_id = '{$postID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$postImages = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$postImages[$i]['id'] 				= $row['id'];
				$postImages[$i]['post_id'] 	    = $row['post_id'];
				$postImages[$i]['image_id'] 		= $row['image_id'];
				$postImages[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($postImages);
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
		if(!isset($user_id)) {
			return http_response_code(400);
		}
		// Validate
        if((int)$id < 1 || 
            !isset($decodedParams['postID']) || $decodedParams['postID'] === '' ||
            !isset($decodedParams['imageID']) || $decodedParams['imageID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		//Retrieve post image to be updated
		$sql = "SELECT * FROM post_image
			WHERE id = '{$id}'";
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$postImage['id'] 			= $row['id'];
			$postImage['post_id'] 	= $row['post_id'];
			$postImage['image_id'] 	    = $row['image_id'];
			$postImage['creation_date'] = $row['creation_date'];
		}else {
			return http_response_code(404);
		}
		$postID = mysqli_real_escape_string($con, $decodedParams['postID']);
		$imageID	= mysqli_real_escape_string($con, $decodedParams['imageID']);
		// SQL
		$sql = "UPDATE post_image
            SET `post_id`='$postID',`image_id`='$imageID'
            WHERE id = '{$id}'";
		//Update
		if(mysqli_query($con, $sql)) {
			$sql = "SELECT * FROM post_image WHERE id = '{$id}'";
			//retrieve updated post image
			if($result = mysqli_query($con, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$postImage['id'] 			= $row['id'];
				$postImage['post_id'] 	= $row['post_id'];
				$postImage['image_id'] 	    = $row['image_id'];
				$postImage['creation_date']	= $row['creation_date'];
				echo json_encode($postImage);
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
		if(!isset($user_id)) {
			return http_response_code(400);
		}
		// Validate.
        if(!isset($decodedParams['postID']) || $decodedParams['postID'] === '' ||
            !isset($decodedParams['imageID']) || $decodedParams['imageID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$postID = mysqli_real_escape_string($con, $decodedParams['postID']);
		$imageID	= isset($decodedParams['imageID']) ?
			mysqli_real_escape_string($con, $decodedParams['imageID']) : "";
		// SQL
		$sql = "INSERT INTO `post_image`(`post_id`,`image_id`)
		VALUES ('{$postID}','{$imageID}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM post_image WHERE id = '{$id}'";
			//retrieve created post image
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$postImage['id'] 			= $row['id'];
				$postImage['post_id'] 	= $row['post_id'];
				$postImage['image_id'] 	    = $row['image_id'];
				$postImage['creation_date'] = $row['creation_date'];
				echo json_encode($postImage);
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
		if(!isset($user_id)) {
			return http_response_code(400);
		}
		// Validate.
		if((int)$id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		// SQL
		$sql = "DELETE FROM `post_image` WHERE `id` ='{$id}'";
		//Delete
		if(mysqli_query($con, $sql)) {
			return http_response_code(201);
		}else {
			return http_response_code(404);
		}
	}
}