<?php
include_once '../HyperDown/Parser.php';
include_once '../config.php';
include_once '../function/common.php';
include_once '../youziku-sdk-php-master/sdk/lib/YouzikuServiceClient.php';

extract($_GET);

$category = file_tree_print(file_tree(MD_ROOT));
$html = 'blog';

// 读取 md 文档
$default_article = MD_ROOT.'/codekissyoung.md';
if(isset($a)){
	$default_article = MD_ROOT.'/'.$_GET['a'].'.md';
}
$content = file_get_contents($default_article);
$parser = new HyperDown\Parser;
$html = $parser -> makeHtml($content);

// 使用有字库字体
$youzikuClient = new YouzikuServiceClient("f540be4b4a0543876f6bef2594149ff7");
$you_yuan = '043c1fde632445c2aaeb57e8631c65b4'; // 幼圆字体
$shi_yuan_hei_ti = '7a5e764d9e6948abb90bd31b847c9ec2'; //思源黑体Light
$microsoft_yahei = '5ab7d6244ba44de8b48439e88019a817'; // 微软雅黑
$param = [
	// "accessKey" => $shi_yuan_hei_ti,
	"accessKey" => $microsoft_yahei,
	"content" => $category . $html,
	"tag" => "*"];
$response = $youzikuClient -> GetFontFace($param);

if(isset($a)){
	echo '<div>'.$html.'</div>';
	exit;
}
// 加载视图
include_once 'view/index.php';
?>

