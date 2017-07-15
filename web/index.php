<?php
include_once '../config.php';

use HyperDown\Parser;

extract($_GET);

$category = file_tree_print(file_tree(MD_ROOT));

// 读取 md 文档
$default_article = MD_ROOT.'/codekissyoung.md';
if(isset($a)){
	$default_article = MD_ROOT.'/'.$_GET['a'].'.md';
}
$content = file_get_contents($default_article);
$parser = new Parser();
$html = $parser -> makeHtml($content);

// 使用有字库字体
$youzikuClient = new YouzikuServiceClient("f540be4b4a0543876f6bef2594149ff7");
$param = [
	"accessKey" => $microsoft_yahei,
	"content" 	=> $category.$html,
	"tag" 		=> "*"];
$response = $youzikuClient -> GetFontFace($param);

if(isset($a)){
	echo '<div>'.$html.'</div>';
	exit;
}
// 加载视图
include_once 'view/index.php';






























