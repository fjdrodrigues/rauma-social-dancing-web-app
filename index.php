<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Amor d'Kizomba</title>
  <base href="/index.php">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="frontend/favicon.ico">
	<link rel="stylesheet" href="frontend/styles.css">
</head>
<body style="height: 100%"></body>
<?php

include_angular_app();
function include_angular_app() {
        echo "<app-root></app-root>";
        echo "<script src=\"frontend/polyfills-es5.js\" nomodule defer></script>";
        echo "<script src=\"frontend/polyfills-es2015.js\" type=\"module\"></script>";
        echo "<script src=\"frontend/runtime-es2015.js\" type=\"module\"></script>";
        echo "<script src=\"frontend/main-es2015.js\" type=\"module\"></script>";
        echo "<script src=\"frontend/runtime-es5.js\" nomodule defer></script>";
        echo "<script src=\"frontend/main-es5.js\" nomodule defer></script>";
}
?>
</html>