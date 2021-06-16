<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Rauma Social Dancing</title>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/svg+xml"
	href="https://gist.githubusercontent.com/fjdrodrigues/d41d59729cbbcc4506d1371384c2b2be/raw/c924dafcff99958828bbcc1515b68846d9b7fd08/angolan_r.svg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body></body>
<?php

include_angular_app();
function include_angular_app() {
        echo "<app-root></app-root>";
        echo "<script src=\"polyfills-es5.js\" nomodule defer></script>";
        echo "<script src=\"polyfills-es2015.js\" type=\"module\"></script>";
        echo "<script src=\"runtime-es2015.js\" type=\"module\"></script>";
        echo "<script src=\"main-es2015.js\" type=\"module\"></script>";
        echo "<script src=\"runtime-es5.js\" nomodule defer></script>";
        echo "<script src=\"main-es5.js\" nomodule defer></script>";
}
?>
</html>