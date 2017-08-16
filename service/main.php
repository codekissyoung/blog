#!/usr/bin/php
<?php
$pid = pcntl_fork();
if($pid == -1){
	echo 'error';
}else if($pid){
	echo 'parent';
}else{
	echo 'child';
	file_put_contents('./file.txt',"i am child process\n",FILE_APPEND);
}



