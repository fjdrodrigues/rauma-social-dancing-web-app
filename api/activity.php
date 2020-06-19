<?php
/**
 * REST API Methods for activities.
 */
include_once './connector.php';

$connection = Connector::connect();

class Activity {

	public static function getOneById($id) {
		global $con;
		// Validate.
		if((int) $id < 1) {
			return http_response_code(400);
		}
		// Sanitize
		$id = mysqli_real_escape_string($con, (int) $id);
		// SQL
		$sql = "SELECT * FROM activity
			WHERE id = '{$id}'";
		//Query
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$activity['id'] 			= $row['id'];
			$activity['title'] 			= $row['title'];
			$activity['description'] 	= $row['description'];
			$activity['category'] 		= $row['category'];
			$activity['location'] 		= $row['location'];
			$activity['start_date'] 	= $row['start_date'];
			$activity['end_date'] 		= $row['end_date'];
			$activity['duration'] 		= $row['duration'];
			$activity['author_id'] 		= $row['author_id'];
			$activity['creation_date']	= $row['creation_date'];
			$activity['last_updated_by']= $row['last_updated_by'];
			$activity['last_update']	= $row['last_update'];
			echo json_encode($activity);
		}else {
			return http_response_code(404);
		}
	}

	public static function getActivities($category) {
		global $con;
		if ($category != null) {
			// Validate.
			if(!is_string($category)) {
				return http_response_code(400);
			}
			// Sanitize
			$category = mysqli_real_escape_string($con, $category);
			// SQL
			$sql = "SELECT * FROM activity
				WHERE category = '{$category}'";
		} else {
			// SQL
			$sql = "SELECT * FROM activity";
		}
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activities = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activities[$i]['id'] 				= $row['id'];
				$activities[$i]['title'] 			= $row['title'];
				$activities[$i]['description'] 		= $row['description'];
				$activities[$i]['category'] 		= $row['category'];
				$activities[$i]['location'] 		= $row['location'];
				$activities[$i]['start_date'] 		= $row['start_date'];
				$activities[$i]['end_date'] 		= $row['end_date'];
				$activities[$i]['duration'] 		= $row['duration'];
				$activities[$i]['author_id'] 		= $row['author_id'];
				$activities[$i]['creation_date']	= $row['creation_date'];
				$activities[$i]['last_updated_by']	= $row['last_updated_by'];
				$activities[$i]['last_update']		= $row['last_update'];
				$i++;
			}
			echo json_encode($activities);
		}else {
			return http_response_code(404);
		}
	}

	public static function getPastActivities($category) {
		global $con;
		if ($category != null) {
			// Validate.
			if(!is_string($category)) {
				return http_response_code(400);
			}
			// Sanitize
			$category = mysqli_real_escape_string($con, $category);
			// SQL
			$sql = "SELECT * FROM activity
				WHERE end_date < CURDATE() AND category = '{$category}'";
		} else {
			// SQL
			$sql = "SELECT * FROM activity
				WHERE end_date < CURDATE()";
		}
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activities = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activities[$i]['id'] 				= $row['id'];
				$activities[$i]['title'] 			= $row['title'];
				$activities[$i]['description'] 		= $row['description'];
				$activities[$i]['category'] 		= $row['category'];
				$activities[$i]['location'] 		= $row['location'];
				$activities[$i]['start_date'] 		= $row['start_date'];
				$activities[$i]['end_date'] 		= $row['end_date'];
				$activities[$i]['duration'] 		= $row['duration'];
				$activities[$i]['author_id'] 		= $row['author_id'];
				$activities[$i]['creation_date']	= $row['creation_date'];
				$activities[$i]['last_updated_by']	= $row['last_updated_by'];
				$activities[$i]['last_update']		= $row['last_update'];
				$i++;
			}
			echo json_encode($activities);
		}else {
			return http_response_code(404);
		}
	}

	public static function getCurrentActivities($category) {
		global $con;
		if ($category != null) {
			// Validate.
			if(!is_string($category)) {
				return http_response_code(400);
			}
			// Sanitize
			$category = mysqli_real_escape_string($con, $category);
			// SQL
			$sql = "SELECT * FROM activity
				WHERE start_date <= CURDATE() AND end_date >= CURDATE() AND category = '{$category}'";	
		} else {
			// SQL
			$sql = "SELECT * FROM activity
				WHERE start_date <= CURDATE() AND end_date >= CURDATE()";
		}
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activities = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activities[$i]['id'] 				= $row['id'];
				$activities[$i]['title'] 			= $row['title'];
				$activities[$i]['description'] 		= $row['description'];
				$activities[$i]['category'] 		= $row['category'];
				$activities[$i]['location'] 		= $row['location'];
				$activities[$i]['start_date'] 		= $row['start_date'];
				$activities[$i]['end_date'] 		= $row['end_date'];
				$activities[$i]['duration'] 		= $row['duration'];
				$activities[$i]['author_id'] 		= $row['author_id'];
				$activities[$i]['creation_date']	= $row['creation_date'];
				$activities[$i]['last_updated_by']	= $row['last_updated_by'];
				$activities[$i]['last_update']		= $row['last_update'];
				$i++;
			}
			echo json_encode($activities);
		}else {
			return http_response_code(404);
		}
	}

	public static function getFutureActivities($category) {
		global $con;
		if ($category != null) {
			// Validate.
			if(!is_string($category)) {
				return http_response_code(400);
			}
			// Sanitize
			$category = mysqli_real_escape_string($con, $category);
			// SQL
			$sql = "SELECT * FROM activity
				WHERE start_date > CURDATE() AND category = '{$category}'";
		} else {
			// SQL
			$sql = "SELECT * FROM activity
				WHERE start_date > CURDATE()";
		}
		//Query
		if($result = mysqli_query($con, $sql)) {
			$activities = [];
			$i = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$activities[$i]['id'] 				= $row['id'];
				$activities[$i]['title'] 			= $row['title'];
				$activities[$i]['description'] 		= $row['description'];
				$activities[$i]['category'] 		= $row['category'];
				$activities[$i]['location'] 		= $row['location'];
				$activities[$i]['start_date'] 		= $row['start_date'];
				$activities[$i]['end_date'] 		= $row['end_date'];
				$activities[$i]['duration'] 		= $row['duration'];
				$activities[$i]['author_id'] 		= $row['author_id'];
				$activities[$i]['creation_date']	= $row['creation_date'];
				$activities[$i]['last_updated_by']	= $row['last_updated_by'];
				$activities[$i]['last_update']		= $row['last_update'];
				$i++;
			}
			echo json_encode($activities);
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
		//Retrieve Activity to be updated
		$sql = "SELECT * FROM activity
			WHERE id = '{$id}'";
		if($result = mysqli_query($con, $sql)) {
			$row = mysqli_fetch_assoc($result);
			$activity['id'] 			= $row['id'];
			$activity['title'] 			= $row['title'];
			$activity['description'] 	= $row['description'];
			$activity['category'] 		= $row['category'];
			$activity['location'] 		= $row['location'];
			$activity['start_date'] 	= $row['start_date'];
			$activity['end_date'] 		= $row['end_date'];
			$activity['duration'] 		= $row['duration'];
			$activity['author_id'] 		= $row['author_id'];
			$activity['creation_date']	= $row['creation_date'];
			$activity['last_updated_by']= $row['last_updated_by'];
			$activity['last_update']	= $row['last_update'];
		}else {
			return http_response_code(404);
		}
		$title 			= mysqli_real_escape_string($con, $decodedParams['title']);
		$description	= isset($decodedParams['description']) ?
			mysqli_real_escape_string($con, $decodedParams['description']) :
			$activity['description'];
		$category 		= isset($decodedParams['category']) ?
			mysqli_real_escape_string($con, $decodedParams['category']) :
			$activity['category'];
		$location 		= isset($decodedParams['location']) ?
			mysqli_real_escape_string($con, $decodedParams['location']) :
			$activity['location'];
		$startDate		= isset($decodedParams['startDate']) ?
			date("Y-m-d", strtotime(mysqli_real_escape_string($con, $decodedParams['startDate']))) :
			$activity['start_date'];
		$endDate 		= isset($decodedParams['endDate']) ?
			date("Y-m-d", strtotime(mysqli_real_escape_string($con, $decodedParams['endDate']))) :
			$activity['end_date'];
		$duration 		= isset($decodedParams['duration']) ?
			mysqli_real_escape_string($con, (int) $decodedParams['duration']) :
			$activity['duration'];
		$lastUpdatedBy = mysqli_real_escape_string($con, (int) $_SESSION['user_id']);
		$lastUpdate = mysqli_real_escape_string($con, time());
		// SQL
		$sql = "UPDATE activity SET `title`='$title',`description`='$description',
			`category`='$category',`location`='$location',`start_date`='$startDate',
			`end_date`='$endDate',`duration`='$duration',`last_updated_by`='$lastUpdatedBy',
			`last_update`='$lastUpdate' WHERE id = '{$id}'";
		//Update
		if(mysqli_query($con, $sql)) {
			$sql = "SELECT * FROM activity WHERE id = '{$id}'";
			//retrieve updated activity
			if($result = mysqli_query($con, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$activity['id'] 			= $row['id'];
				$activity['title'] 			= $row['title'];
				$activity['description'] 	= $row['description'];
				$activity['category'] 		= $row['category'];
				$activity['location'] 		= $row['location'];
				$activity['start_date'] 	= $row['start_date'];
				$activity['end_date'] 		= $row['end_date'];
				$activity['duration'] 		= $row['duration'];
				$activity['author_id'] 		= $row['author_id'];
				$activity['creation_date']	= $row['creation_date'];
				$activity['last_updated_by']= $row['last_updated_by'];
				$activity['last_update']	= $row['last_update'];
				echo json_encode($activity);
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
		$description	= isset($decodedParams['description']) ?
			mysqli_real_escape_string($con, $decodedParams['description']) : "";
		$category 		= isset($decodedParams['category']) ?
			mysqli_real_escape_string($con, $decodedParams['category']) : "";
		$location 		= isset($decodedParams['location']) ?
			mysqli_real_escape_string($con, $decodedParams['location']) : "";
		$startDate		= isset($decodedParams['startDate']) ?
			date("Y-m-d", strtotime(mysqli_real_escape_string($con, $decodedParams['startDate']))) :
			"";
		$endDate 		= isset($decodedParams['endDate']) ?
			date("Y-m-d", strtotime(mysqli_real_escape_string($con, $decodedParams['endDate']))) :
			"";
		$duration 		= isset($decodedParams['duration']) ?
			mysqli_real_escape_string($con, (int) $decodedParams['duration']) : "";
		$authorID		= mysqli_real_escape_string($con, (int) $_SESSION['user_id']);
		$lastUpdatedBy = mysqli_real_escape_string($con, (int) $_SESSION['user_id']);
		// SQL
		$sql = "INSERT INTO `activity`(`title`,`description`,`category`,`location`,
		`start_date`,`end_date`,`duration`,`author_id`,`last_updated_by`)
		VALUES ('{$title}','{$description}','{$category}','{$location}',
		'{$startDate}','{$endDate}','{$duration}','{$authorID}','{$lastUpdatedBy}')";
		//Create
		if(mysqli_query($con, $sql)) {
			$id = mysqli_insert_id($con);
			$sql = "SELECT * FROM activity WHERE id = '{$id}'";
			//retrieve created activity
			if($result = mysqli_query($con,$sql)) {
				$row = mysqli_fetch_assoc($result);
				$activity['id'] 			= $row['id'];
				$activity['title'] 			= $row['title'];
				$activity['description'] 	= $row['description'];
				$activity['category'] 		= $row['category'];
				$activity['location'] 		= $row['location'];
				$activity['start_date'] 	= $row['start_date'];
				$activity['end_date'] 		= $row['end_date'];
				$activity['duration'] 		= $row['duration'];
				$activity['author_id'] 		= $row['author_id'];
				$activity['creation_date']	= $row['creation_date'];
				$activity['last_updated_by']= $row['last_updated_by'];
				$activity['last_update']	= $row['last_update'];
				echo json_encode($activity);
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
		$sql = "DELETE FROM `activity` WHERE `id` ='{$id}'";
		//Delete
		if(mysqli_query($con, $sql)) {
			return http_response_code(201);
		}else {
			return http_response_code(404);
		}
	}
}
?>