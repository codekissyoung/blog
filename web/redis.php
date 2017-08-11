<?php
	echo phpinfo();exit();
	$redis = new Redis();
	$redis->connect('127.0.0.1', 6379);
	echo "Connection to server sucessfully";
	echo "Server is running: ".$redis->ping();

	var_dump($redis);






