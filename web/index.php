<?php
include_once '../config.php';

use HyperDown\Parser;

extract($_GET);
$file_tree = file_tree(MD_ROOT);
$category = file_tree_print(file_tree(MD_ROOT));

// 读取 md 文档
$default_article = MD_ROOT.'/link.md';
$ri = urldecode($_SERVER["PATH_INFO"]);
if($ri){
	$default_article = MD_ROOT."{$ri}.md";
}
if(is_file($default_article)){
	$content = file_get_contents($default_article);
}else{
	$content = "文章不存在"; // 404
}

$parser = new Parser();
$html = $parser -> makeHtml($content);

if($_GET['ajax']){
	echo '<div>'.$html.'</div>';
	exit;
}
// 使用有字库字体
/*
$youzikuClient = new YouzikuServiceClient("f540be4b4a0543876f6bef2594149ff7");
$param = [
	"accessKey" => $microsoft_yahei,
	"content" 	=> $category.$html,
	"tag" 		=> "*"];
$response = $youzikuClient -> GetFontFace($param);
*/
// debug($category);
// 加载视图
include_once 'view/index.php';



























