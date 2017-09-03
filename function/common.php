<?php
// $path 路径 返回目录树数组
function file_tree($path){
	$tree = scandir($path);
	sort($tree,SORT_NUMERIC); // 按照数值大小排序数组，主要考虑到看书的笔记，目录方便记录
	foreach($tree as $key => $leaf){
		if($leaf == "." || $leaf == ".."){
			unset($tree[$key]);
		}elseif(is_dir($path.'/'.$leaf)){
			unset($tree[$key]);
			$tree[$leaf] = file_tree($path.'/'.$leaf);
		}
	}
	return $tree;
}

// $tree 是目录数组 $title_i 是章节计数 $path 是目录
function file_tree_print($tree,$path = false){
	$i = 1; // 计数
	$html = $path ? "<ul class=hide>":"<ul>";
	foreach($tree as $key => $leaf)
	{
		if($key === 'img') continue; // 过滤图片文件夹

		if(is_array($leaf))
		{
			$html .= "<li><h2>$key<span class=caret></span></h2>".file_tree_print($leaf,"{$path}/{$key}")."</li>";
		}
		else
		{
			if(!preg_match("/md$/",$leaf)) continue;  // 跳过不是md结尾的文件
			if($leaf == "link.md") continue; // 跳过我自己的简历

			$leaf = substr($leaf,0,-3);
			if($path){
				$href = "$path/$leaf";	
			}else{
				$href = "/$leaf";
			}
			$html .= "<li><a href='$href'>$leaf</a></li>";
		}
		$i++;
	}
	$html .= "</ul>";
	return $html;
}


function debug($var){
	echo "<pre><code>";
	print_r($var);
	echo "</code></pre>";
	exit;
}




