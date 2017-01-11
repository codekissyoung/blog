<?php
   	   $news_id=$_GET["news_id"];
   	   $entity="";
   	   $doc=new DOMDocument();
       $doc->load('news.xml');
       $news=$doc->getElementsByTagName("news");
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
    
    <style type="text/css">
    	
    	<?php
    		echo $entity->getElementsByTagName("fontfacecontent")->item(0)->nodeValue.';';
        ?> 
    </style>
     <style type="text/css">
     <?php
     echo $entity->getElementsByTagName("fontfacetitle")->item(0)->nodeValue.';';
      ?>
     </style>
  <style type="text/css">
     <?php
   echo $entity->getElementsByTagName("fontfaceadddate")->item(0)->nodeValue.'';
      ?>
     </style>
</head>
<body>
   
    <div>
        <table style="width: 594px" align=center>
            <tr>
                <td align="center" style="width: 594px" class="title">
                    
                    <label id="title" style="font-size: X-Large;color:Red ;"><?php echo $entity->getElementsByTagName("news_title")->item(0)->nodeValue ?></label>
                    </td>
            </tr>
           <tr>
                <td align="center"  >
                         <label id="adddate"><?php echo $entity->getElementsByTagName("news_adddate")->item(0)->nodeValue ?></label></td>
            </tr>
            <tr>
                <td style="width: 594px" class="content">
                    <label id="content"> <?php echo $entity->getElementsByTagName("news_content")->item(0)->nodeValue ?></label></td>
            </tr>
        </table>
    
    </div>
  
</body>
</html>
