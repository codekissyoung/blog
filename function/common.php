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
		if(is_string($leaf)){
			$html .= $title_i ? "<li><a href='/?a=$path/$leaf'>$title_i.$i $leaf</a></li>":"<li><a href='/?a=$leaf'>$i $leaf</a></li>";
		}else{
			$html .= $title_i ? "<li><h2>$title_i.$i $key</h2>".file_tree_print($leaf,$title_i.'.'.$i,$path."/".$key)."</li>":
			"<li><h2>$i $key</h2>".file_tree_print($leaf,$i,$key)."</li>";
		}
		$i++;
	}
	$html .= "</ul>";
	return $html;
}
