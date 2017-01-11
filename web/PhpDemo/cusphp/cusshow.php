<?php
   	   $news_id=$_GET["news_id"];
   	   $entity="";
   	   $doc=new DOMDocument();
       $doc->load('cusnews.xml');
       $news=$doc->getElementsByTagName("news");
       if($news->length<=0){
            header("Location: cusadd.php");
       }
   	     for($i=0;$i<$news->length;$i++){
                    	$item=$news->item($i);
                    	if($item->getElementsByTagName("news_id")->item(0)->nodeValue==$news_id){		
                    		$entity=$item;
                    	}
         }
   	
   	?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>

    	<?php
   echo '<style type="text/css">@font-face{font-family:"fontfamilytitle'.$entity->getElementsByTagName("news_id")->item(0)->nodeValue.'"; src:url("http://cdn.webfont.youziku.com/webfonts/custompath/41418CEB9E6AE8A8/apidemo/php/cus/'.$entity->getElementsByTagName("news_id")->item(0)->nodeValue.'/title.bmp" ) format("woff") }</style>'
   
        ?> 

      	<?php
   echo '<style type="text/css">@font-face{font-family:"fontfamilycontent'.$entity->getElementsByTagName("news_id")->item(0)->nodeValue.'"; src:url("http://cdn.webfont.youziku.com/webfonts/custompath/41418CEB9E6AE8A8/apidemo/php/cus/'.$entity->getElementsByTagName("news_id")->item(0)->nodeValue.'/content.bmp" ) format("woff") }</style>'
   
        ?> 

</head>
<body>
   
    <div>
        <table style="width: 594px" align=center>
            <tr>

            <?php 
                 echo '<td align="center"  class="title" style="width: 594px;font-family:fontfamilytitle'.$entity->getElementsByTagName("news_id")->item(0)->nodeValue.'" class="content"><label id="title" style="font-size: X-Large;color:Red"> '.$entity->getElementsByTagName("news_title")->item(0)->nodeValue. '</label></td>'
            ?>
             
            </tr>
           <tr>
                <td align="center"  >
                         <label id="adddate"><?php echo $entity->getElementsByTagName("news_adddate")->item(0)->nodeValue ?></label></td>
            </tr>
            <tr>
                <?php  
                   echo '<td style="width: 594px;font-family:fontfamilycontent'.$entity->getElementsByTagName("news_id")->item(0)->nodeValue.'" class="content"><label id="content"> '.$entity->getElementsByTagName("news_content")->item(0)->nodeValue. '</label></td>'
                ?>
 
        
            </tr>
        </table>
    
    </div>
  
</body>
</html>
