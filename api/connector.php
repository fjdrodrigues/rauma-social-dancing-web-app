<?php
#Production
#define('DB_HOST', 'fdb13.biz.nf');
#define('DB_USER', '1783013_adk');
#define('DB_PASS', 'adkpass123');
#define('DB_NAME', '1783013_adk');

#Dev
define('DB_HOST', 'localhost');
define('DB_USER', 'admin');
define('DB_PASS', 'admin');
define('DB_NAME', 'adk');

class Connector {

	public static function connect()
	{
	  $connect = mysqli_connect(DB_HOST ,DB_USER ,DB_PASS ,DB_NAME);

	  if (mysqli_connect_errno($connect)) {
		die("Failed to connect:" . mysqli_connect_error());
	  }

	  mysqli_set_charset($connect, "utf8");

	  return $connect;
	}
}
?>