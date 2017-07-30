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
function file_tree_print($tree,$title_i = false,$path = false){
	$i = 1; // 计数
	$html = "<ul>"; // 要生成的html代码
	if($title_i){
		$html = "<ul class=hide>"; // 隐藏目录结构
	}
	foreach($tree as $key => $leaf){
		if($key === 'img'){ // 过滤用于存放图片的img 文件夹
			continue;
		}
		if(!is_string($leaf)){
			$html .= $title_i ? "<li><h2>$key<span class=caret></span> </h2>".file_tree_print($leaf,$title_i.'.'.$i,$path."/".$key)."</li>":
			"<li><h2>$key<span class=caret></span> </h2>".file_tree_print($leaf,$i,$key)."</li>";
		}else{
			if(!preg_match("/md$/",$leaf)) {
				continue;  // 跳过不是md结尾的文件
			}
			// 跳过我自己的简历
			if($leaf == "link.md"){
				continue;
			}
			$leaf = substr($leaf,0,-3);
			$html .= $title_i ? 
			"<li><a href='/?a=$path/$leaf'><span class='head-tag'></span>$leaf</a></li>"
			:
			"<li><a href='/?a=$leaf'>$leaf</a></li>";
		}
		$i++;
	}
	$html .= "</ul>";
	return $html;
}

