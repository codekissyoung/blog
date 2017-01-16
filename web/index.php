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

}

// 使用有字库字体
$youzikuClient = new YouzikuServiceClient("f540be4b4a0543876f6bef2594149ff7");
$you_yuan = '043c1fde632445c2aaeb57e8631c65b4'; // 幼圆字体
$shi_yuan_hei_ti = '7a5e764d9e6948abb90bd31b847c9ec2'; //思源黑体Light
$microsoft_yahei = '5ab7d6244ba44de8b48439e88019a817'; // 微软雅黑
$param = [
	"accessKey"=>$shi_yuan_hei_ti,
	"content"=> $category . $html,
	"tag"=>"*"];
$response = $youzikuClient -> GetFontFace($param);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?=isset($article) ? $article.' ' :'';?>Codekissyoung Blog</title>
        <link href="//cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet">
		<link href="/css/common.css?time=<?=time();?>" rel="stylesheet"/>
		<link href="/highlight.js/src/styles/github.css" rel="stylesheet">
        <script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
        <script src="/js/common.js"></script>
		<style>
		 <?=$response -> FontFace;?>
		</style>
	</head>
	<body>
	<nav id="main_category">
		<h1 class="main-title">Codekissyoung Blog</h1>
        <input type="button" value="按钮" id="btn" />
        <button id="btn2">按钮2</button>
        <input type="button" value="按钮3" id="btn3" />
        <script type="text/javascript">
            var eventUtil = {
                // 添加事件
                add:function(e,t,h){
                    if(e.addEventListener){
                        e.addEventListener(t,h,false);
                    }else if(e.attachEvent){
                        e.attachEvent('on'+t,h);
                    }else {
                        e['on'+type] = h;
                    }
                },
                // 删除事件
                delete:function(e,t,h){
                    if(e.removeEventListener){
                        e.removeEventListener(t,h,false);
                    }else if(e.detachEvent){
                        e.detachEvent('on'+t,h);
                    }else{
                        e['on'+t] = null;
                    }
                }
            }
            function showMsg(event){
                console.log(event.type); // 事件类型
                console.log(event.target);　// 该事件的dom
                console.log(event.srcElement); // 该事件的dom ie
                if(event.stopPropagation){
                    event.stopPropagation(); // 阻止事件冒泡
                }else{
                    event.cancelBubble = true;  // 阻止事件冒泡 ie
                }
                if(event.preventDefault){
                    event.preventDefault(); // 阻止默认事件行为
                }else{
                    event.returnValue=false;   // 阻止默认事件行为 ie 
                }
            }
            eventUtil.add(document.getElementById('btn'),'click',showMsg);
            eventUtil.add(document.getElementById('btn2'),'click',function(){
                console.log(this);
            });
            eventUtil.add(document.getElementById('btn3'),'click',function(){
                console.log(this);
            });
        </script>
		<?=$category?>
	</nav>
	<div id="article">
		<div>
			<?=$html;?>
		</div>
	</div>
	<script>
		hljs.initHighlightingOnLoad();
		var as = document.getElementsByTagName('a');
		for(var x in as ){
			if(location.href == as[x].href){
				as[x].className = "active";
			}
		}
	</script>
	</body>
</html>
