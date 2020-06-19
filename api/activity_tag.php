<?php
/**
 * REST API Methods for activity tags.
 */
include_once './connector.php';

$connection = Connector::connect();

class ActivityTag {

	public static function getOneById($id) {
		global $con;
		// Validate.
		if((int)$id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		// SQL
		$sql = "SELECT * FROM activity_tag
			WHERE id = '{$id}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$activityTag['id'] 			= $row['id'];
			$activityTag['activity_id']   = $row['activity_id'];
			$activityTag['tag_id'] 	    = $row['tag_id'];
			$activityTag['creation_date']	= $row['creation_date'];
			echo json_encode($activityTag);
		}else {
			return http_response_code(404);
		}
	}

	public static function getActivityTags() {
		global $con;
		// SQL
		$sql = "SELECT * FROM activity_tag";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activityTags = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activityTags[$i]['id'] 				= $row['id'];
				$activityTags[$i]['activity_id'] 		= $row['activity_id'];
				$activityTags[$i]['tag_id'] 		= $row['tag_id'];
				$activityTags[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($activityTags);
		}else {
			return http_response_code(404);
		}
	}

	public static function getActivitiesForTag($tagID) {
		global $con;
		// Validate.
        if((int)$tagID < 1) {
            return http_response_code(400);
        }
        // Sanitize
        $category = mysqli_real_escape_string($con, $tagID);
        // SQL
        $sql = "SELECT * FROM activity_tag
            WHERE tag_id = '{$tagID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activityTags = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activityTags[$i]['id'] 				= $row['id'];
				$activityTags[$i]['activity_id'] 	    = $row['activity_id'];
				$activityTags[$i]['tag_id'] 		= $row['tag_id'];
				$activityTags[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($activityTags);
		}else {
			return http_response_code(404);
		}
	}

	public static function getTagsForActivity($activityID) {
		global $con;
		// Validate.
        if((int)$activityID < 1) {
            return http_response_code(400);
        }
        // Sanitize
        $category = mysqli_real_escape_string($con, $activityID);
        // SQL
        $sql = "SELECT * FROM activity_tag
            WHERE activity_id = '{$activityID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activityTags = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activityTags[$i]['id'] 				= $row['id'];
				$activityTags[$i]['activity_id'] 	    = $row['activity_id'];
				$activityTags[$i]['tag_id'] 		= $row['tag_id'];
				$activityTags[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($activityTags);
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
            !isset($decodedParams['activityID']) || $decodedParams['activityID'] === '' ||
            !isset($decodedParams['tagID']) || $decodedParams['tagID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		//Retrieve activity tag to be updated
		$sql = "SELECT * FROM activity_tag
			WHERE id = '{$id}'";
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$activityTag['id'] 			= $row['id'];
			$activityTag['activity_id'] 	= $row['activity_id'];
			$activityTag['tag_id'] 	    = $row['tag_id'];
			$activityTag['creation_date'] = $row['creation_date'];
		}else {
			return http_response_code(404);
		}
		$activityID = mysqli_real_escape_string($con, $decodedParams['activityID']);
		$tagID	= mysqli_real_escape_string($con, $decodedParams['tagID']);
		// SQL
		$sql = "UPDATE activity_tag
            SET `activity_id`='$activityID',`tag_id`='$tagID'
            WHERE id = '{$id}'";
		//Update
		if(mysqli_query($con, $sql)) {
			$sql = "SELECT * FROM activity_tag WHERE id = '{$id}'";
			//retrieve updated activity tag
			if($result = mysqli_query($con, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$activityTag['id'] 			= $row['id'];
				$activityTag['activity_id'] 	= $row['activity_id'];
				$activityTag['tag_id'] 	    = $row['tag_id'];
				$activityTag['creation_date']	= $row['creation_date'];
				echo json_encode($activityTag);
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
        if(!isset($decodedParams['activityID']) || $decodedParams['activityID'] === '' ||
            !isset($decodedParams['tagID']) || $decodedParams['tagID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$activityID = mysqli_real_escape_string($con, $decodedParams['activityID']);
		$tagID	= isset($decodedParams['tagID']) ?
			mysqli_real_escape_string($con, $decodedParams['tagID']) : "";
		// SQL
		$sql = "INSERT INTO `activity_tag`(`activity_id`,`tag_id`)
		VALUES ('{$activityID}','{$tagID}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM activity_tag WHERE id = '{$id}'";
			//retrieve created activity tag
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$activityTag['id'] 			= $row['id'];
				$activityTag['activity_id'] 	= $row['activity_id'];
				$activityTag['tag_id'] 	    = $row['tag_id'];
				$activityTag['creation_date'] = $row['creation_date'];
				echo json_encode($activityTag);
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
		$sql = "DELETE FROM `activity_tag` WHERE `id` ='{$id}'";
		//Delete
		if(mysqli_query($con, $sql)) {
			return http_response_code(201);
		}else {
			return http_response_code(404);
		}
	}
}