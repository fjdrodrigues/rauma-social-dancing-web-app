<?php
/**
 * REST API Methods for post videos.
 */
include_once './connector.php';

$connection = Connector::connect();

class PostVideo {

	public static function getOneById($id) {
		global $con;
		// Validate.
		if((int)$id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		// SQL
		$sql = "SELECT * FROM post_video
			WHERE id = '{$id}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$postVideo['id'] 			= $row['id'];
			$postVideo['post_id']   = $row['post_id'];
			$postVideo['video_id'] 	    = $row['video_id'];
			$postVideo['creation_date']	= $row['creation_date'];
			echo json_encode($postVideo);
		}else {
			return http_response_code(404);
		}
	}

	public static function getPostVideos() {
		global $con;
		// SQL
		$sql = "SELECT * FROM post_video";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$postVideos = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$postVideos[$i]['id'] 				= $row['id'];
				$postVideos[$i]['post_id'] 		= $row['post_id'];
				$postVideos[$i]['video_id'] 		= $row['video_id'];
				$postVideos[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($postVideos);
		}else {
			return http_response_code(404);
		}
	}

	public static function getPostsForVideo($videoID) {
		global $con;
		// Validate.
        if((int)$videoID < 1) {
            return http_response_code(400);
        }
        // Sanitize
        $category = mysqli_real_escape_string($con, $videoID);
        // SQL
        $sql = "SELECT * FROM post_video
            WHERE video_id = '{$videoID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$postVideos = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$postVideos[$i]['id'] 				= $row['id'];
				$postVideos[$i]['post_id'] 	    = $row['post_id'];
				$postVideos[$i]['video_id'] 		= $row['video_id'];
				$postVideos[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($postVideos);
		}else {
			return http_response_code(404);
		}
	}

	public static function getVideosForPost($postID) {
		global $con;
		// Validate.
        if((int)$postID < 1) {
            return http_response_code(400);
        }
        // Sanitize
        $category = mysqli_real_escape_string($con, $postID);
        // SQL
        $sql = "SELECT * FROM post_video
            WHERE post_id = '{$postID}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$postVideos = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$postVideos[$i]['id'] 				= $row['id'];
				$postVideos[$i]['post_id'] 	    = $row['post_id'];
				$postVideos[$i]['video_id'] 		= $row['video_id'];
				$postVideos[$i]['creation_date']    = $row['creation_date'];
				$i++;
			}
			echo json_encode($postVideos);
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
            !isset($decodedParams['videoID']) || $decodedParams['videoID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int)$id);
		//Retrieve post video to be updated
		$sql = "SELECT * FROM post_video
			WHERE id = '{$id}'";
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$postVideo['id'] 			= $row['id'];
			$postVideo['post_id'] 	= $row['post_id'];
			$postVideo['video_id'] 	    = $row['video_id'];
			$postVideo['creation_date'] = $row['creation_date'];
		}else {
			return http_response_code(404);
		}
		$postID = mysqli_real_escape_string($con, $decodedParams['postID']);
		$videoID	= mysqli_real_escape_string($con, $decodedParams['videoID']);
		// SQL
		$sql = "UPDATE post_video
            SET `post_id`='$postID',`video_id`='$videoID'
            WHERE id = '{$id}'";
		//Update
		if(mysqli_query($con, $sql)) {
			$sql = "SELECT * FROM post_video WHERE id = '{$id}'";
			//retrieve updated post video
			if($result = mysqli_query($con, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$postVideo['id'] 			= $row['id'];
				$postVideo['post_id'] 	= $row['post_id'];
				$postVideo['video_id'] 	    = $row['video_id'];
				$postVideo['creation_date']	= $row['creation_date'];
				echo json_encode($postVideo);
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
            !isset($decodedParams['videoID']) || $decodedParams['videoID'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$postID = mysqli_real_escape_string($con, $decodedParams['postID']);
		$videoID	= isset($decodedParams['videoID']) ?
			mysqli_real_escape_string($con, $decodedParams['videoID']) : "";
		// SQL
		$sql = "INSERT INTO `post_video`(`post_id`,`video_id`)
		VALUES ('{$postID}','{$videoID}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM post_video WHERE id = '{$id}'";
			//retrieve created post video
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$postVideo['id'] 			= $row['id'];
				$postVideo['post_id'] 	= $row['post_id'];
				$postVideo['video_id'] 	    = $row['video_id'];
				$postVideo['creation_date'] = $row['creation_date'];
				echo json_encode($postVideo);
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
		$sql = "DELETE FROM `post_video` WHERE `id` ='{$id}'";
		//Delete
		if(mysqli_query($con, $sql)) {
			return http_response_code(201);
		}else {
			return http_response_code(404);
		}
	}
}