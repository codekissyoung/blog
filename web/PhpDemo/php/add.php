<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<body>
    <form id="form1" action="add.php" method="post">
    <div>
    <table style="width: 578px" align=center>
            <tr>
                <td colspan="2" align="center">
                    多标签接口调用演示</td>
            </tr>
            <tr>
                <td style="width: 100px">
                    标题：</td>
                <td style="width: 93px">
                	<input type="text" id="title" value=""  name="title" style="width: 196px;" />                   
                   </td>
            </tr>
        
            <tr>
                <td style="width: 100px; height: 127px;">
                    内容：</td>
                <td style="width: 93px; height: 127px;">
                	<textarea id="content" name="content"  style="height: 132px;width: 429px;"></textarea>
                 </td>
            </tr>
            <tr>
                <td style="height: 21px" colspan="2">
                	<input type="submit" value="提交" style="width: 93px;" />
                    <input type="button" value="返回新闻列表" />
                   </td>
            </tr>
        </table>
    </div>
    </form>
</body>
</html>


<?php
	 require_once '../lib/YouzikuServiceClient.php';
	
	if($_SERVER['REQUEST_METHOD']=="POST"){
		
   $news_title=$_POST["title"];

   $news_content=$_POST["content"];
   $news_adddate=date('y-m-d h:i:s',time());
   
   

   $youzikuClient=new YouzikuServiceClient("89cea6396460ef6e9c3a4f15f064e799");
   $param[0]=array("accessKey"=>"9f2384e04e44470ea63b52fc5f519ad5","content"=>$news_title,"tag"=>".title");
    $param[1]=array("accessKey"=>"9f2384e04e44470ea63b52fc5f519ad5","content"=>$news_content,"tag"=>".content");
     $param[2]=array("accessKey"=>"9f2384e04e44470ea63b52fc5f519ad5","content"=>$news_adddate,"tag"=>".adddate");

   $res=$youzikuClient->GetBatchWoffFontFace($param);

   if($res->Code=="200"){
   	 	
   	handleXml($news_title,$news_content,$news_adddate,$res);
   	
   }
   
      
 	
   }
   
   
  
      function handleXml($news_title,$news_content,$news_adddate,$res){
      	
      	
    $doc=new DOMDocument();
    $doc->load('news.xml');
   
  
    $xinwen=$doc->documentElement;
   
   
   $id=1;
   $newsinfo=$doc->getElementsByTagName("news");
   if($newsinfo->length>0){
   	 $item=$newsinfo->item($newsinfo->length-1);
   	 $id=intval($item->getElementsByTagName("news_id")->item(0)->nodeValue)+1;
    
   }
   
   $news= $doc->createElement('news');
   $xinwen->appendChild($news);
   
   $newsid=$doc->createElement('news_id');
   $news->appendChild($newsid);
   $newid_val=$doc->createTextNode($id);
   $newsid->appendChild($newid_val);
   
   $newtitle=$doc->createElement('news_title');
   $news->appendChild($newtitle);
   $newtitle_val=$doc->createTextNode($news_title);
   $newtitle->appendChild($newtitle_val);
   
   $newcontent=$doc->createElement("news_content");
   $news->appendChild($newcontent);
   $newcontent_val=$doc->createTextNode($news_content);
   $newcontent->appendChild($newcontent_val);
   
    $newadddate=$doc->createElement("news_adddate");
    $news->appendChild($newadddate);
    $newadddate_val=$doc->createTextNode($news_adddate);
    $newadddate->appendChild($newadddate_val);
  
    $xfontfacetitle=$doc->createElement("fontfacetitle");
    $news->appendChild($xfontfacetitle);
   
    
    $xfontfamilytitle = $doc->createElement("fontfamilytitle");
     $news->appendChild($xfontfamilytitle);
     
    $xfontfacecontent =$doc->createElement("fontfacecontent");
     $news->appendChild($xfontfacecontent); 
      
    $xfontfamilycontent =$doc->createElement("fontfamilycontent");
     $news->appendChild($xfontfamilycontent);
     
     
     
     $xfontfaceadddate =$doc->createElement("fontfaceadddate");
     $news->appendChild($xfontfaceadddate); 
      
    $xfontfamilyadddate =$doc->createElement("fontfamilyadddate");
     $news->appendChild($xfontfamilyadddate);
     
    $arr=$res->FontfaceList;
    for($i=0;$i<count($arr);$i++){
   	
   	 switch ($arr[$i]->Tag)
                    {
                        case ".title":
                           
                        $xfontfacetitle->appendChild($doc->createTextNode($arr[$i]->FontFace)); 
                        $xfontfamilytitle->appendChild($doc->createTextNode($arr[$i]->FontFamily));
                            break;
                     
                        case ".content":
                        $xfontfacecontent->appendChild($doc->createTextNode($arr[$i]->FontFace)); 
                        $xfontfamilycontent->appendChild($doc->createTextNode($arr[$i]->FontFamily));
                            break;
                          case ".adddate":
                        $xfontfaceadddate->appendChild($doc->createTextNode($arr[$i]->FontFace)); 
                        $xfontfamilyadddate->appendChild($doc->createTextNode($arr[$i]->FontFamily));
                            break;   
                            
                        default:
                            break;
                    }
   	
   	
   }
   
   
    $fp=fopen('news.xml',"w");
	fwrite($fp,$doc->saveXML());
    header("Location: list.php");
			
     }
      
?>