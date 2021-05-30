<?php
/**
 * REST API Methods for activity videos.
 */
include_once './connector.php';




class ActivityVideo {

	public static function getOneById($id) {
		global $con;
		// Validate.
		if((int)$id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		// SQL
		$sql = "SELECT * FROM activity_video
			WHERE id = '{$id}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$activityVideo['id'] 			= $row['id'];
			$activityVideo['activity_id']   = $row['activity_id'];
			$activityVideo['video_id'] 	    = $row['video_id'];
			$activityVideo['creation_date']	= $row['creation_date'];
			echo json_encode($activityVideo);
		}else {
			return http_response_code(404);
		}
	}

	public static function getActivityVideos() {
		global $con;
		// SQL
		$sql = "SELECT * FROM activity_video";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activityVideos = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activityVideos[$i]['id'] 				= $row['id'];
				$activityVideos[$i]['activity_id'] 		= $row['activity_id'];
				$activityVideos[$i]['video_id'] 		= $row['video_id'];
				$activityVideos[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($activityVideos);
		}else {
			return http_response_code(404);
		}
	}

	public static function getActivitiesForVideo($videoID) {
		global $con;
		// Validate.
		if((int)$videoID < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$category = mysqli_real_escape_string($con, $videoID);
		// SQL
		$sql = "SELECT * FROM activity_video
			WHERE video_id = '{$videoID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activityVideos = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activityVideos[$i]['id'] 				= $row['id'];
				$activityVideos[$i]['activity_id'] 	    = $row['activity_id'];
				$activityVideos[$i]['video_id'] 		= $row['video_id'];
				$activityVideos[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($activityVideos);
		}else {
			return http_response_code(404);
		}
	}

	public static function getVideosForActivity($activityID) {
		global $con;
		// Validate.
		if((int)$activityID < 1) {
			return;
		}
		// Sanitize
		$category = mysqli_real_escape_string($con, $activityID);
		// SQL
		$sql = "SELECT * FROM activity_video
			WHERE activity_id = '{$activityID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activityVideos = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activityVideos[$i]['id'] 				= $row['id'];
				$activityVideos[$i]['activity_id'] 	    = $row['activity_id'];
				$activityVideos[$i]['video_id'] 		= $row['video_id'];
				$activityVideos[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			return $activityVideos;
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
			!isset($decodedParams['videoID']) || $decodedParams['videoID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		//Retrieve activity video to be updated
		$sql = "SELECT * FROM activity_video
			WHERE id = '{$id}'";
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$activityVideo['id'] 			= $row['id'];
			$activityVideo['activity_id'] 	= $row['activity_id'];
			$activityVideo['video_id'] 	    = $row['video_id'];
			$activityVideo['creation_date'] = $row['creation_date'];
		}else {
			return http_response_code(404);
		}
		$activityID = mysqli_real_escape_string($con, $decodedParams['activityID']);
		$videoID	= mysqli_real_escape_string($con, $decodedParams['videoID']);
		// SQL
		$sql = "UPDATE activity_video
			SET `activity_id`='$activityID',`video_id`='$videoID'
			WHERE id = '{$id}'";
		//Update
		if(mysqli_query($con, $sql)) {
			$sql = "SELECT * FROM activity_video WHERE id = '{$id}'";
			//retrieve updated activity video
			if($result = mysqli_query($con, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$activityVideo['id'] 			= $row['id'];
				$activityVideo['activity_id'] 	= $row['activity_id'];
				$activityVideo['video_id'] 	    = $row['video_id'];
				$activityVideo['creation_date']	= $row['creation_date'];
				echo json_encode($activityVideo);
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
			!isset($decodedParams['videoID']) || $decodedParams['videoID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$activityID = mysqli_real_escape_string($con, $decodedParams['activityID']);
		$videoID	= mysqli_real_escape_string($con, $decodedParams['videoID']);
		// SQL
		$sql = "INSERT INTO `activity_video`(`activity_id`,`video_id`)
			VALUES ('{$activityID}','{$videoID}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM activity_video WHERE id = '{$id}'";
			//retrieve created activity video
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$activityVideo['id'] 			= $row['id'];
				$activityVideo['activity_id'] 	= $row['activity_id'];
				$activityVideo['video_id'] 	    = $row['video_id'];
				$activityVideo['creation_date'] = $row['creation_date'];
				echo json_encode($activityVideo);
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
			!isset($params['video_id']) || $params['video_id'] === '') {
			return;
		}
		// Sanitize
		$activityID = mysqli_real_escape_string($con, $params['activity_id']);
		$videoID	= mysqli_real_escape_string($con, $params['video_id']);
		// SQL
		$sql = "INSERT INTO `activity_video`(`activity_id`,`video_id`)
			VALUES ('{$activityID}','{$videoID}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM activity_video WHERE id = '{$id}'";
			//retrieve created activity video
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$activityVideo['id'] 			= $row['id'];
				$activityVideo['activity_id'] 	= $row['activity_id'];
				$activityVideo['video_id'] 	    = $row['video_id'];
				$activityVideo['creation_date'] = $row['creation_date'];
				return $activityVideo;
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
		$sql = "DELETE FROM `activity_video` WHERE `id` ='{$id}'";
		//Delete
		mysqli_query($con, $sql);
	}
}