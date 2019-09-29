<?php
require '../connector.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)) {
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if($request->title === '') {
    return http_response_code(400);
  }

  // Sanitize
  $title = mysqli_real_escape_string($con, $request->title);
  $text = mysqli_real_escape_string($con, $request->text);
  $category = mysqli_real_escape_string($con, $request->category);

  // Create.
  $sql = "INSERT INTO `posts`(`title`,`text`,`category`) VALUES ('{$title}','{$text}','{$category}')";

  if(mysqli_query($con,$sql)) {
    http_response_code(201);
    $post = [
      'title'		=> $title,
      'text'		=> $text,
      'category'	=> $category
    ];
    echo json_encode($post);
  }else {
    http_response_code(422);
  }
}
?>