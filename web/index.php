<?php
include '../HyperDown/Parser.php';
include '../config.php';
include '../function/common.php';

use HyperDown\Paser;
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Codekissyoung</title>
		<link href="/css/common.css?time=<?=time();?>" rel="stylesheet"/>
		<link href="/highlight.js/src/styles/github.css" rel="stylesheet">
		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
	</head>
	<body>
	<nav class="main_category">
		<?=file_tree_print(file_tree(MD_ROOT))?>
	</nav>
	<?php if(isset($_GET['a'])):?>
		<?php
			$article = $_GET['a'];
			$content = file_get_contents(MD_ROOT.'/'.$article);

			$parser = new HyperDown\Parser;
			$html = $parser -> makeHtml($content);
		?>
		<div id="article">
			<!-- <p>当前文章:<?=$article?></p> -->
			<div>
				<?=$html;?>
			</div>
		</div>
	<?php endif;?>
	<script>
		hljs.initHighlightingOnLoad();
		var as = document.getElementsByTagName('a');
		// console.log(as);
		console.log();
		for(var x in as ){
			if(location.href == as[x].href){
				console.log(as[x].href);
				as[x].className = "active";
			}

		}

	</script>
	</body>
</html>
