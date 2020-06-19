<?php
require '../connector.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata, true);

  // Validate.
  if((int)$request->id < 1 || $request->title === '')
  {
    return http_response_code(400);
  }

  // Sanitize
  $id    = mysqli_real_escape_string($con, (int)$request->id);
  $title = mysqli_real_escape_string($con, $request->title);
  $text = mysqli_real_escape_string($con, $request->text);
  $category = mysqli_real_escape_string($con, $request->category);

  // Update.
  $sql = "UPDATE `posts` SET `title`='$title',`text`='$text', `category`='$category' WHERE `id` = '{$id}' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}
?>