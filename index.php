<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Rauma Social Dancing</title>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image" content="https://i.ibb.co/Rp1YXn8/collage-1-900x425.png"/>
  <meta property="og:type" content="website"/>
  <meta property="og:url" content="http://www.raumasocialdancing.fi"/>
  <meta property="og:title" content="Rauma Social Dancing"/>
  <meta property="og:description" content="Rauma based social dancing promoters with fun and accessible classes."/>
  <link rel="icon" type="image/svg+xml"
	href="https://gist.githubusercontent.com/fjdrodrigues/b85a307811f2c69c9732969005819ace/raw/d11b58cd98cecad0fadae804e3465ea56ab08e61/angola_r.svg">
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