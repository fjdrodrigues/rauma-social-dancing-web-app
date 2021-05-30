<?php
/**
 * REST API Methods for activity images.
 */
include_once './connector.php';




class ActivityImage {

	public static function getOneById($id) {
		global $con;
		// Validate.
		if((int)$id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		// SQL
		$sql = "SELECT * FROM activity_image
			WHERE id = '{$id}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$activityImage['id'] 			= $row['id'];
			$activityImage['activity_id']   = $row['activity_id'];
			$activityImage['image_id'] 	    = $row['image_id'];
			$activityImage['creation_date']	= $row['creation_date'];
			echo json_encode($activityImage);
		}else {
			return http_response_code(404);
		}
	}

	public static function getActivityImages() {
		global $con;
		// SQL
		$sql = "SELECT * FROM activity_image";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activityImages = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activityImages[$i]['id'] 				= $row['id'];
				$activityImages[$i]['activity_id'] 		= $row['activity_id'];
				$activityImages[$i]['image_id'] 		= $row['image_id'];
				$activityImages[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($activityImages);
		}else {
			return http_response_code(404);
		}
	}

	public static function getActivitiesForImage($imageID) {
		global $con;
		// Validate.
		if((int)$imageID < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$category = mysqli_real_escape_string($con, $imageID);
		// SQL
		$sql = "SELECT * FROM activity_image
			WHERE image_id = '{$imageID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activityImages = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activityImages[$i]['id'] 				= $row['id'];
				$activityImages[$i]['activity_id'] 	    = $row['activity_id'];
				$activityImages[$i]['image_id'] 		= $row['image_id'];
				$activityImages[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($activityImages);
		}else {
			return http_response_code(404);
		}
	}

	public static function getImagesForActivity($activityID) {
		global $con;
		// Validate.
		if((int)$activityID < 1) {
			return;
		}
		// Sanitize
		$category = mysqli_real_escape_string($con, $activityID);
		// SQL
		$sql = "SELECT * FROM activity_image
			WHERE activity_id = '{$activityID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activityImages = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activityImages[$i]['id'] 				= $row['id'];
				$activityImages[$i]['activity_id'] 	    = $row['activity_id'];
				$activityImages[$i]['image_id'] 		= $row['image_id'];
				$activityImages[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			return $activityImages;
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
			!isset($decodedParams['activityID']) || $decodedParams['activityID'] === '' ||
			!isset($decodedParams['imageID']) || $decodedParams['imageID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		//Retrieve activity image to be updated
		$sql = "SELECT * FROM activity_image
			WHERE id = '{$id}'";
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$activityImage['id'] 			= $row['id'];
			$activityImage['activity_id'] 	= $row['activity_id'];
			$activityImage['image_id'] 	    = $row['image_id'];
			$activityImage['creation_date'] = $row['creation_date'];
		}else {
			return http_response_code(404);
		}
		$activityID = mysqli_real_escape_string($con, $decodedParams['activityID']);
		$imageID	= mysqli_real_escape_string($con, $decodedParams['imageID']);
		// SQL
		$sql = "UPDATE activity_image
			SET `activity_id`='$activityID',`image_id`='$imageID'
			WHERE id = '{$id}'";
		//Update
		if(mysqli_query($con, $sql)) {
			$sql = "SELECT * FROM activity_image WHERE id = '{$id}'";
			//retrieve updated activity image
			if($result = mysqli_query($con, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$activityImage['id'] 			= $row['id'];
				$activityImage['activity_id'] 	= $row['activity_id'];
				$activityImage['image_id'] 	    = $row['image_id'];
				$activityImage['creation_date']	= $row['creation_date'];
				echo json_encode($activityImage);
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
		if(!isset($decodedParams['activityID']) || $decodedParams['activityID'] === '' ||
			!isset($decodedParams['imageID']) || $decodedParams['imageID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$activityID = mysqli_real_escape_string($con, $decodedParams['activityID']);
		$imageID	= mysqli_real_escape_string($con, $decodedParams['imageID']);
		// SQL
		$sql = "INSERT INTO `activity_image`(`activity_id`,`image_id`)
			VALUES ('{$activityID}','{$imageID}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM activity_image WHERE id = '{$id}'";
			//retrieve created activity image
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$activityImage['id'] 			= $row['id'];
				$activityImage['activity_id'] 	= $row['activity_id'];
				$activityImage['image_id'] 	    = $row['image_id'];
				$activityImage['creation_date'] = $row['creation_date'];
				echo json_encode($activityImage);
			}else {
				return http_response_code(404);
			}
		}else {
			return http_response_code(404);
		}
	}

	public static function createBackend($params) {
		global $con;
		// Validate.
		if(!isset($params['activity_id']) || $params['activity_id'] === '' ||
			!isset($params['image_id']) || $params['image_id'] === '') {
			return;
		}
		// Sanitize
		$activityID = mysqli_real_escape_string($con, $params['activity_id']);
		$imageID	= mysqli_real_escape_string($con, $params['imageid']);
		// SQL
		$sql = "INSERT INTO `activity_image`(`activity_id`,`image_id`)
			VALUES ('{$activityID}','{$imageID}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM activity_image WHERE id = '{$id}'";
			//retrieve created activity image
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$activityImage['id'] 			= $row['id'];
				$activityImage['activity_id'] 	= $row['activity_id'];
				$activityImage['image_id'] 	    = $row['image_id'];
				$activityImage['creation_date'] = $row['creation_date'];
				return $activityImage;
			}
		}
	}

	public static function delete($id) {
		global $con;
		// Validate.
		if((int)$id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		// SQL
		$sql = "DELETE FROM `activity_image` WHERE `id` ='{$id}'";
		//Delete
		mysqli_query($con, $sql);
	}
}