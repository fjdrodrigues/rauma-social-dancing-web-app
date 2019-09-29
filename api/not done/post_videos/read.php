<?php
/**
 * Returns the list of posts.
 */
require '../connector.php';

$posts = [];
$sql = "SELECT * FROM posts";

if($result = mysqli_query($con,$sql)) {
  $i = 0;
  while($row = mysqli_fetch_assoc($result)) {
    $posts[$i]['id'] 						= $row['id'];
    $posts[$i]['title'] 				= $row['title'];
    $posts[$i]['text'] 					= $row['text'];
		$posts[$i]['category'] 			= $row['category'];
    $posts[$i]['author_id'] 		= $row['author_id'];
    $posts[$i]['creation_date']	= $row['creation_date'];
    $i++;
  }

  echo json_encode($posts);
}else {
  http_response_code(404);
}
?>