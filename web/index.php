<?php
include_once '../HyperDown/Parser.php';
include_once '../config.php';
include_once '../function/common.php';
include_once '../youziku-sdk-php-master/sdk/lib/YouzikuServiceClient.php';
use HyperDown\Paser;

extract($_GET);

$category = file_tree_print(file_tree(MD_ROOT));
$html = 'blog';

// 读取 md 文档
if(isset($a)){
	$article = $_GET['a'];
	$content = file_get_contents(MD_ROOT.'/'.$article);
	$parser = new HyperDown\Parser;
	$html = $parser -> makeHtml($content);
}else{
	$content = file_get_contents(MD_ROOT.'/codekissyoung.txt');
	$parser  = new HyperDown\Parser;
	$html    = $parser -> makeHtml($content);
}

// 使用有字库字体
$youzikuClient = new YouzikuServiceClient("f540be4b4a0543876f6bef2594149ff7");
$you_yuan = '043c1fde632445c2aaeb57e8631c65b4'; // 幼圆字体
$shi_yuan_hei_ti = '7a5e764d9e6948abb90bd31b847c9ec2'; //思源黑体Light
$microsoft_yahei = '5ab7d6244ba44de8b48439e88019a817'; // 微软雅黑
$param = [
	"accessKey" => $shi_yuan_hei_ti,
	// "accessKey" => $microsoft_yahei,
	"content" => $category . $html,
	"tag" => "*"];
$response = $youzikuClient -> GetFontFace($param);

if(isset($a)){
	echo '<div>'.$html.'</div>';
	exit;
}

?>
<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="utf-8">
        <title><?=isset($article) ? $article.' ' :'';?>Codekissyoung Blog</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link href="//cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet">
		<link href="/css/common.css?time=<?=time();?>" rel="stylesheet"/>
		<link href="/highlight.js/src/styles/github.css" rel="stylesheet">
		<script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
		<script src="/js/common.js"></script>
		<style>
		 <?php // echo $response -> FontFace;?>
         .hide{
             display: none;
         }
         .show{
             display: block;
         }
		</style>
	</head>
	<body>
	<?php if(!isset($a)):?>
	<nav id="main_category">
		<h1 class="main-title">Codekissyoung Blog</h1>
		<?=$category?>
	</nav>
	<?php endif; ?>
	<div id="article">
		<div>
			<?=$html;?>
		</div>
	</div>
	<script>
		// 代码高亮
		hljs.initHighlightingOnLoad();

		// 异步加载文章
		$('#main_category a').on('click',function(){
			$("#main_category a").removeClass('active');
			$(this).addClass('active');
			var href = $(this).attr('href');
			$.ajax({
				url:href,
				type:'GET',
				data:{},
				dataType:'text',
				timeout:5000,
				success:function(data){
					$("#article").empty().append($(data)).find('pre code').each(function(i,block){
						hljs.highlightBlock(block);
					});
				}
			});
			return false; // 阻止冒泡 阻止事件
		});

        // 目录折叠
        $("#main_category>ul h2").on('click',function () {
            if($(this).next().hasClass('hide')){
                $(this).next().removeClass('hide').hasClass('show');
            }else{
                $(this).next().removeClass('show').addClass('hide');
            }
        });

	</script>
	</body>
</html>
