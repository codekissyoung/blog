<?php
include '../config.php';
include '../function/common.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Codekissyoung</title>
		<link href="/css/common.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="/pagedown/demo/browser/demo.css" />
        <script type="text/javascript" src="/pagedown/Markdown.Converter.js"></script>
        <script type="text/javascript" src="/pagedown/Markdown.Sanitizer.js"></script>
        <script type="text/javascript" src="/pagedown/Markdown.Editor.js"></script>
	</head>
	<body>
	<?=file_tree_print(file_tree(MD_ROOT))?>
	<?php if(isset($_GET['a'])):?>
		<?php
			$article = $_GET['a'];
			$content = file_get_contents(MD_ROOT.'/'.$article);
		?>
		<p>当前文章:<?=$article?></p>
		<div>
			<pre><?=$content;?></pre>
		</div>
	<?php endif;?>
	</body>
</html>
