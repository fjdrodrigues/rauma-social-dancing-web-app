<?php
/**
 * REST API Methods for activities.
 */
include_once './connector.php';

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
			$activity['id'] 						= $row['id'];
			$activity['title'] 					= $row['title'];
			$activity['description'] 		= $row['description'];
			$activity['category'] 			= $row['category'];
			$activity['location'] 			= $row['location'];
			$activity['start_date'] 		= $row['start_date'];
			$activity['end_date'] 			= $row['end_date'];
			$activity['duration'] 			= $row['duration'];
			$activity['author_id'] 			= $row['author_id'];
			$activity['creation_date']	= $row['creation_date'];
			$activity['last_updated_by']= $row['last_updated_by'];
			$activity['last_update']		= $row['last_update'];

			//Query Tags
			// SQL
			$sql = "SELECT t.id, t.name, t.author_id, t.creation_date
				FROM tag as t
				JOIN activity_tag as a
				ON t.id = a.tag_id
				WHERE a.activity_id = '{$id}'";
			// Query
			if($result = mysqli_query($con, $sql)) {
				$tags = [];
				$i = 0;
				while($row = mysqli_fetch_assoc($result)) {
					$tags[$i]['id'] 					= $row['id'];
					$tags[$i]['name'] 				= $row['name'];
					$tags[$i]['author_id'] 		= $row['author_id'];
					$tags[$i]['creation_date']= $row['creation_date'];
					$i++;
				}
				$activity['tags'] = $tags;
			}

			//Query Images
			// SQL
			$sql = "SELECT i.id, i.url, i.author_id, i.creation_date
			FROM image as i
			JOIN activity_image as a
			ON i.id = a.image_id
			WHERE a.activity_id = '{$id}'";
			// Query
			if($result = mysqli_query($con, $sql)) {
				$images = [];
				$i = 0;
				while($row = mysqli_fetch_assoc($result)) {
					$images[$i]['id'] 					= $row['id'];
					$images[$i]['url'] 					= $row['url'];
					$images[$i]['author_id']		= $row['author_id'];
					$images[$i]['creation_date']= $row['creation_date'];
					$i++;
				}
				$activity['images'] = $images;
			}

			//Query Videos
			// SQL
			$sql = "SELECT v.id, v.url, v.author_id, v.creation_date
			FROM video as v
			JOIN activity_video as a
			ON v.id = a.video_id
			WHERE a.activity_id = '{$id}'";
			// Query
			if($result = mysqli_query($con, $sql)) {
				$videos = [];
				$i = 0;
				while($row = mysqli_fetch_assoc($result)) {
					$videos[$i]['id'] 					= $row['id'];
					$videos[$i]['url'] 					= $row['url'];
					$videos[$i]['author_id'] 		= $row['author_id'];
					$videos[$i]['creation_date']= $row['creation_date'];
					$i++;
				}
				$activity['videos'] = $videos;
			}
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
				$activities[$i]['id'] 						= $row['id'];
				$activities[$i]['title'] 					= $row['title'];
				$activities[$i]['description'] 		= $row['description'];
				$activities[$i]['category'] 			= $row['category'];
				$activities[$i]['location'] 			= $row['location'];
				$activities[$i]['start_date'] 		= $row['start_date'];
				$activities[$i]['end_date'] 			= $row['end_date'];
				$activities[$i]['duration'] 			= $row['duration'];
				$activities[$i]['author_id'] 			= $row['author_id'];
				$activities[$i]['creation_date']	= $row['creation_date'];
				$activities[$i]['last_updated_by']= $row['last_updated_by'];
				$activities[$i]['last_update']		= $row['last_update'];

				//Query Tags
				// SQL
				$sql2 = "SELECT t.id, t.name, t.author_id, t.creation_date
				FROM tag as t
				JOIN activity_tag as a
				ON t.id = a.tag_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$tags = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$tags[$j]['id'] 					= $row2['id'];
						$tags[$j]['name'] 				= $row2['name'];
						$tags[$j]['author_id'] 		= $row2['author_id'];
						$tags[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activities[$i]['tags'] = $tags;
				}

				//Query Images
				// SQL
				$sql2 = "SELECT i.id, i.url, i.author_id, i.creation_date
				FROM image as i
				JOIN activity_image as a
				ON i.id = a.image_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$images = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$images[$j]['id'] 					= $row2['id'];
						$images[$j]['url'] 					= $row2['url'];
						$images[$j]['author_id']		= $row2['author_id'];
						$images[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activity[$i]['images'] = $images;
				}

				//Query Videos
				// SQL
				$sql2 = "SELECT v.id, v.url, v.author_id, v.creation_date
				FROM video as v
				JOIN activity_video as a
				ON v.id = a.video_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$videos = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$videos[$j]['id'] 					= $row2['id'];
						$videos[$j]['url'] 					= $row2['url'];
						$videos[$j]['author_id'] 		= $row2['author_id'];
						$videos[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activity[$i]['videos'] = $videos;
				}
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

				//Query Tags
				// SQL
				$sql2 = "SELECT t.id, t.name, t.author_id, t.creation_date
				FROM tag as t
				JOIN activity_tag as a
				ON t.id = a.tag_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$tags = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$tags[$j]['id'] 					= $row2['id'];
						$tags[$j]['name'] 				= $row2['name'];
						$tags[$j]['author_id'] 		= $row2['author_id'];
						$tags[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activities[$i]['tags'] = $tags;
				}

				//Query Images
				// SQL
				$sql2 = "SELECT i.id, i.url, i.author_id, i.creation_date
				FROM image as i
				JOIN activity_image as a
				ON i.id = a.image_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$images = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$images[$j]['id'] 					= $row2['id'];
						$images[$j]['url'] 					= $row2['url'];
						$images[$j]['author_id']		= $row2['author_id'];
						$images[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activity[$i]['images'] = $images;
				}

				//Query Videos
				// SQL
				$sql2 = "SELECT v.id, v.url, v.author_id, v.creation_date
				FROM video as v
				JOIN activity_video as a
				ON v.id = a.video_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$videos = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$videos[$j]['id'] 					= $row2['id'];
						$videos[$j]['url'] 					= $row2['url'];
						$videos[$j]['author_id'] 		= $row2['author_id'];
						$videos[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activity[$i]['videos'] = $videos;
				}
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

				//Query Tags
				// SQL
				$sql2 = "SELECT t.id, t.name, t.author_id, t.creation_date
				FROM tag as t
				JOIN activity_tag as a
				ON t.id = a.tag_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$tags = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$tags[$j]['id'] 					= $row2['id'];
						$tags[$j]['name'] 				= $row2['name'];
						$tags[$j]['author_id'] 		= $row2['author_id'];
						$tags[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activities[$i]['tags'] = $tags;
				}

				//Query Images
				// SQL
				$sql2 = "SELECT i.id, i.url, i.author_id, i.creation_date
				FROM image as i
				JOIN activity_image as a
				ON i.id = a.image_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$images = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$images[$j]['id'] 					= $row2['id'];
						$images[$j]['url'] 					= $row2['url'];
						$images[$j]['author_id']		= $row2['author_id'];
						$images[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activity[$i]['images'] = $images;
				}

				//Query Videos
				// SQL
				$sql2 = "SELECT v.id, v.url, v.author_id, v.creation_date
				FROM video as v
				JOIN activity_video as a
				ON v.id = a.video_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$videos = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$videos[$j]['id'] 					= $row2['id'];
						$videos[$j]['url'] 					= $row2['url'];
						$videos[$j]['author_id'] 		= $row2['author_id'];
						$videos[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activity[$i]['videos'] = $videos;
				}
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

				//Query Tags
				// SQL
				$sql2 = "SELECT t.id, t.name, t.author_id, t.creation_date
				FROM tag as t
				JOIN activity_tag as a
				ON t.id = a.tag_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$tags = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$tags[$j]['id'] 					= $row2['id'];
						$tags[$j]['name'] 				= $row2['name'];
						$tags[$j]['author_id'] 		= $row2['author_id'];
						$tags[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activities[$i]['tags'] = $tags;
				}

				//Query Images
				// SQL
				$sql2 = "SELECT i.id, i.url, i.author_id, i.creation_date
				FROM image as i
				JOIN activity_image as a
				ON i.id = a.image_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$images = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$images[$j]['id'] 					= $row2['id'];
						$images[$j]['url'] 					= $row2['url'];
						$images[$j]['author_id']		= $row2['author_id'];
						$images[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activity[$i]['images'] = $images;
				}

				//Query Videos
				// SQL
				$sql2 = "SELECT v.id, v.url, v.author_id, v.creation_date
				FROM video as v
				JOIN activity_video as a
				ON v.id = a.video_id
				WHERE a.activity_id = '{$activities[$i]['id']}'";
				// Query
				if($result2 = mysqli_query($con, $sql2)) {
					$videos = [];
					$j = 0;
					while($row2 = mysqli_fetch_assoc($result2)) {
						$videos[$j]['id'] 					= $row2['id'];
						$videos[$j]['url'] 					= $row2['url'];
						$videos[$j]['author_id'] 		= $row2['author_id'];
						$videos[$j]['creation_date']= $row2['creation_date'];
						$j++;
					}
					$activity[$i]['videos'] = $videos;
				}
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
		if(!isset($user_id)) {
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
			// Update Tags
			$existingTags = ActivityTag::getTagsForActivity($id);
			$newTags = isset($decodedParams['tags']) ?
				 $decodedParams['tags'] : '';
			$activityTagsToDelete = Activity::ActivityTagAndTagArrayDiff($existingTags, $newTags, 0);
			foreach ($activityTagsToDelete as $activityTag) {
				ActivityTag::delete($activityTag['id']);
			}
			$tagsToCreate = Activity::ActivityTagAndTagArrayDiff($newTags, $existingTags, 1);
			foreach ($tagsToCreate as $tag) {
				$activityTag['tag_id'] = $tag['id'];
				$activityTag['activity_id'] = $id;
				ActivityTag::createBackend($activityTag);
			}
			// Update Images
			$existingImages = ActivityImage::getImagesForActivity($id);
			$newImages = isset($decodedParams['images']) ?
				$decodedParams['images'] : '';
			$activityImagesToDelete = Activity::ActivityImageAndImageArrayDiff($existingImages, $newImages, 0);
			foreach ($activityImagesToDelete as $activityImage) {
				ActivityImage::delete($activityImage['id']);
			}
			$imagesToCreate = Activity::ActivityImageAndImageArrayDiff($newImages, $existingImages, 1);
			foreach ($imagesToCreate as $image) {
				$activityImage['image_id'] = $image['id'];
				$activityImage['activity_id'] = $id;
				ActivityImage::createBackend($activityImage);
			}
			// Update Videos
			$existingVideos = ActivityVideo::getVideosForActivity($id);
			$newVideos = isset($decodedParams['videos']) ?
				$decodedParams['videos'] : '';
			$activityVideosToDelete = Activity::ActivityVideoAndVideoArrayDiff($existingVideos, $newVideos, 0);
			foreach ($activityVideosToDelete as $activityVideo) {
				ActivityVideo::delete($activityVideo['id']);
			}
			$videosToCreate = Activity::ActivityVideoAndVideoArrayDiff($newVideos, $existingVideos, 1);
			foreach ($videosToCreate as $video) {
				$activityVideo['video_id'] = $video['id'];
				$activityVideo['activity_id'] = $id;
				ActivityVideo::createBackend($activityVideo);
			}

			//retrieve updated activity
			$sql = "SELECT * FROM activity WHERE id = '{$id}'";
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
				$activity['tags'] = $newTags;
				$activity['images'] = $newImages;
				$activity['videos'] = $newVideos;
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
		if(!isset($user_id)) {
			return http_response_code(400);
		}
		// Validate.
		if (!isset($decodedParams['title']) || $decodedParams['title'] === '') {
			return http_response_code(400);
		}
		// Sanitize
		$title 				= mysqli_real_escape_string($con, $decodedParams['title']);
		$description	= isset($decodedParams['description']) ?
			mysqli_real_escape_string($con, $decodedParams['description']) : "";
		$category 		= isset($decodedParams['category']) ?
			mysqli_real_escape_string($con, $decodedParams['category']) : "";
		$location 		= isset($decodedParams['location']) ?
			mysqli_real_escape_string($con, $decodedParams['location']) : "";
		$startDate		= isset($decodedParams['startDate']) ?
			date("Y-m-d", strtotime(mysqli_real_escape_string($con, $decodedParams['startDate']))) :
			"";
		$endDate 			= isset($decodedParams['endDate']) ?
			date("Y-m-d", strtotime(mysqli_real_escape_string($con, $decodedParams['endDate']))) :
			"";
		$duration 		= isset($decodedParams['duration']) ?
			mysqli_real_escape_string($con, (int) $decodedParams['duration']) : "";
		$authorID			= mysqli_real_escape_string($con, (int) $_SESSION['user_id']);
		$lastUpdatedBy= mysqli_real_escape_string($con, (int) $_SESSION['user_id']);

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

				// Add Tags
				if (isset($decodedParams['tags'])) {
					$tags = $decodedParams['tags'];
					foreach ($tags as $tag) {
						$activity_tag['tag_id'] = $tag['id'];
						$activity_tag['activity_id'] = $activity['id'];
						ActivityTag::createBackend($activity_tag);
					}
					$activity['tags'] = $tags;
				}
				// Add Images
				if (isset($decodedParams['images'])) {
					$images = $decodedParams['images'];
					foreach ($images as $image) {
						$activity_image['image_id'] = $image['id'];
						$activity_image['activity_id'] = $activity['id'];
						ActivityImage::createBackend($activity_image);
					}
					$activity['images'] = $images;
				}
				// Add Videos
				if (isset($decodedParams['videos'])) {
					$videos = $decodedParams['videos'];
					foreach ($videos as $video) {
						$activity_video['video_id'] = $video['id'];
						$activity_video['activity_id'] = $activity['id'];
						ActivityVideo::createBackend($activity_video);
					}
					$activity['videos'] = $videos;
				}
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
		if(!isset($user_id)) {
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
			// Delete Tags
			// SQL
			$sql = "DELETE FROM `activity_tag` WHERE `activity_id` ='{$id}'";
			mysqli_query($con, $sql);
			// Delete Images
			// SQL
			$sql = "DELETE FROM `activity_image` WHERE `activity_id` ='{$id}'";
			mysqli_query($con, $sql);
			// Delete Videos
			// SQL
			$sql = "DELETE FROM `activity_video` WHERE `activity_id` ='{$id}'";
			mysqli_query($con, $sql);
			return http_response_code(201);
		}else {
			return http_response_code(404);
		}
	}

	private static function ActivityTagAndTagArrayDiff($array1, $array2, $mode) {
		$array_diff = [];
		foreach($array1 as $elem1) {
			$aux = false;
			foreach($array2 as $elem2) {
				if ($mode == 0) {
					if ($elem1['tag_id'] == $elem2['id']) {
						$aux = true;
						break;
					}
				} elseif ($mode == 1) {
					if ($elem1['id'] == $elem2['tag_id']) {
						$aux = true;
						break;
					}
				}
			}
			if (!$aux) {
				array_push($array_diff, $elem1);
			}
		}
		return $array_diff;
	}

	private static function ActivityImageAndImageArrayDiff($array1, $array2, $mode) {
		$array_diff = [];
		foreach($array1 as $elem1) {
			$aux = false;
			foreach($array2 as $elem2) {
				if ($mode == 0) {
					if ($elem1['image_id'] == $elem2['id']) {
						$aux = true;
						break;
					}
				} elseif ($mode == 1) {
					if ($elem1['id'] == $elem2['image_id']) {
						$aux = true;
						break;
					}
				}
			}
			if (!$aux) {
				array_push($array_diff, $elem1);
			}
		}
		return $array_diff;
	}

	private static function ActivityVideoAndVideoArrayDiff($array1, $array2, $mode) {
		$array_diff = [];
		foreach($array1 as $elem1) {
			$aux = false;
			foreach($array2 as $elem2) {
				if ($mode == 0) {
					if ($elem1['video_id'] == $elem2['id']) {
						$aux = true;
						break;
					}
				} elseif ($mode == 1) {
					if ($elem1['id'] == $elem2['video_id']) {
						$aux = true;
						break;
					}
				}
			}
			if (!$aux) {
				array_push($array_diff, $elem1);
			}
		}
		return $array_diff;
	}
}
?>