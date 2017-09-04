<?php
include_once '../config.php';

// 博客当前访问文章
$ri = isset($_SERVER['PATH_INFO']) ? urldecode($_SERVER["PATH_INFO"]) : '';
if($ri)
{
	$article = MD_ROOT."{$ri}.md";
}
else
{
	$article = MD_ROOT.'/link.md';
}

// 加载文章内容
if(is_file($article))
{
	$content = file_get_contents($article);
}
else
{
	$content = "文章不存在"; // 404
}
$parser = new HyperDown\Parser();
$html = $parser -> makeHtml($content);


// 使用有字库字体
/*
$youzikuClient = new YouzikuServiceClient("f540be4b4a0543876f6bef2594149ff7");
$param = [
	"accessKey" => $microsoft_yahei,
	"content" 	=> $category.$html,
	"tag" 		=> "*"];
$response = $youzikuClient -> GetFontFace($param);
*/

$title = trim(join('-',explode("/",$ri))."-CodeKissYoung Blog",'-');

// 加载视图
if(isset($_GET['ajax']))
{
	include_once 'view/article.php';
}
else
{
	$category = file_tree_print( file_tree(MD_ROOT) , $ri );
	include_once 'view/index.php';
}











