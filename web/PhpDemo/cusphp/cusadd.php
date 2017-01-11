<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<body>
    <form id="form1" action="cusadd.php" method="post">
    <div>
    <table style="width: 578px" align=center>
            <tr>
                <td colspan="2" align="center">
                    自定义接口调用演示</td>
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
                    <a href="cuslist" style="text-dec"><input type="button" value="返回新闻列表" /></a>
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
   if($news_title=="")
   {
       echo "请输入标题!";
       return ;
   }
      if($news_content=="")
   {
       echo "请输入内容!";
       return;
   }
   
      $num =GetXmlNum(); 
     $youzikuServiceClient=new YouzikuServiceClient("89cea6396460ef6e9c3a4f15f064e799");
      
     $param[0]=array("accessKey"=>"990d5c64760a4ca6a12db545c05ef91f","content"=>$news_title,"url"=>("apidemo/php/cus/".$num."/title"));
        $param[1]=array("accessKey"=>"990d5c64760a4ca6a12db545c05ef91f","content"=>$news_content,"url"=>("apidemo/php/cus/".$num."/content"));

      $res=$youzikuServiceClient->CreateBatchWebFontAsync($param);

   if($res->Code=="200"){
   	 	
   	handleXml($news_title,$news_content,$news_adddate);
   	
   }

 }
   
     
//获取当前是第几条数据
function GetXmlNum()
{
        $doc=new DOMDocument();
    $doc->load('cusnews.xml');  
    $xinwen=$doc->documentElement;    
   $id=1;
   $newsinfo=$doc->getElementsByTagName("news");
   if($newsinfo->length>0){
   	 $item=$newsinfo->item($newsinfo->length-1);
   	 $id=intval($item->getElementsByTagName("news_id")->item(0)->nodeValue)+1;
    
   }else{
       $id=1;
   }
   return $id;
}


      
//操作xml
function handleXml($news_title,$news_content,$news_adddate){     	
      	
    //加载xml
    $doc=new DOMDocument();
    $doc->load('cusnews.xml');  
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

    $fp=fopen('cusnews.xml',"w");
	fwrite($fp,$doc->saveXML());
    header("Location: cuslist.php");
			
     }
      
?>