<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
	</head>

	<body>

		<div>
			<div>
				<table cellspacing="0" cellpadding="4" id="GridView1" style="color:#333333;width:707px;border-collapse:collapse;">
					<tr style="color:White;background-color:#990000;font-weight:bold;">
						<th scope="col">编号</th>
						<th scope="col">标题</th>
						<th scope="col">添加时间</th>
					</tr>
					
					<?php 
						
                	$str="";
                	
                	$doc=new DOMDocument();
                    $doc->load('news.xml');
                    $news=$doc->getElementsByTagName("news");
                    
                    for($i=0;$i<$news->length;$i++){
                    	$item=$news->item($i);
                    	
                    	if($i%2!=0){
                    			$str.='<tr style="color:#333333;background-color:#FFFBD6;"><td>'.$item->getElementsByTagName("news_id")->item(0)->nodeValue.'</td><td><style type="text/css">'.$item->getElementsByTagName("fontfacetitle")->item(0)->nodeValue.'</style><a style="font-family:'.$item->getElementsByTagName("fontfamilytitle")->item(0)->nodeValue.'" target="_blank" href="show.php?news_id='.$item->getElementsByTagName("news_id")->item(0)->nodeValue.'">'.$item->getElementsByTagName("news_title")->item(0)->nodeValue.'</a></td><td>'.$item->getElementsByTagName("news_adddate")->item(0)->nodeValue.'</td></tr>'; 
                    	}else{
                    			$str.='<tr style="ccolor:#333333;background-color:White;"><td>'.$item->getElementsByTagName("news_id")->item(0)->nodeValue.'</td><td><style type="text/css">'.$item->getElementsByTagName("fontfacetitle")->item(0)->nodeValue.'</style><a style="font-family:'.$item->getElementsByTagName("fontfamilytitle")->item(0)->nodeValue.'" target="_blank" href="show.php?news_id='.$item->getElementsByTagName("news_id")->item(0)->nodeValue.'">'.$item->getElementsByTagName("news_title")->item(0)->nodeValue.'</a></td><td>'.$item->getElementsByTagName("news_adddate")->item(0)->nodeValue.'</td></tr>'; 
                    		
                    	}
                    
                    	 	
                    }
                    
    
                   echo $str;

                 ?>
		
				</table>
			</div>

			<br />
			<a href="test.php">添加新闻</a>
		</div>

	</body>

</html>