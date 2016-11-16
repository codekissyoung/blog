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
		<link href="/css/common.css" rel="stylesheet"/>
		<!-- <link href="http://github.com/yrgoldteeth/darkdowncss/raw/master/darkdown.css" rel="stylesheet"></link> -->
		<link href="/highlight.js/src/styles/github.css" rel="stylesheet">
		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
	</head>
	<body>
	<?=file_tree_print(file_tree(MD_ROOT))?>
	<?php if(isset($_GET['a'])):?>
		<?php
			$article = $_GET['a'];
			$content = file_get_contents(MD_ROOT.'/'.$article);

			$parser = new HyperDown\Parser;
			$html = $parser -> makeHtml($content);
		?>
		<p>当前文章:<?=$article?></p>
		<?=$html;?>
	<?php endif;?>
	<script>
		hljs.initHighlightingOnLoad();
	</script>
	</body>
</html>
