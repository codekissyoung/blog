<?php
// $path 路径 返回目录树数组
function file_tree($path){
	$tree = scandir($path);
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
	foreach($tree as $key => $leaf){
		if($key === 'img'){ // 过滤用于存放图片的img 文件夹
			continue;
		}
		if(!is_string($leaf)){
			$html .= $title_i ? "<li><h2>$title_i.$i $key</h2>".file_tree_print($leaf,$title_i.'.'.$i,$path."/".$key)."</li>":
			"<li><h2>$i $key</h2>".file_tree_print($leaf,$i,$key)."</li>";
		}else{
			if(!preg_match("/md$/",$leaf)) continue;  // 跳过不是md结尾的文件
			$html .= $title_i ? "<li><a href='/?a=$path/$leaf'><span class='head-tag'>$title_i.$i</span> $leaf</a></li>":"<li><a href='/?a=$leaf'>$i $leaf</a></li>";
		}
		$i++;
	}
	$html .= "</ul>";
	return $html;
}
