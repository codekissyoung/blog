<!-- <!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>css</title>
        <style>
            *{
                margin: 0px;
                padding: 0px;
                /*outline: 1px solid red;*/
            }
            .d1{
                margin:40px 0px;
                background-color:#eeffff;
                padding:10px 0px;

            }
            .d2{
                margin: 20px 0px;
                height: 50px;
                background-color: #eeeeee;
            }
            .d3{
                margin:20px 0px;
                padding:10px 0px;
                background-color: pink;
                height: 0;
            }
        </style>
    </head>
    <body>
        <div style="height:10px;background-color:black;">
        </div>
        <div class="d1">
            <div class="d2">
            </div>
        </div>

        <div class="d3">
        </div>

    </body>
</html> -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;" />
<meta charset="utf-8">
<title>滑动门</title>
<style media="screen" type="text/css">
<!--
*{font-size:12px;}
html,body{margin:0;text-align:center;over-flow:hidden;height:100%;width:100%;}
UL{list-style-type:none; margin:0px;}
/* 标准盒模型 */
.ttl{height:18px;}
.ctt{height:auto;padding:6px;clear:both;border:1px solid #064ca1;border-top:0;text-align:left;}
.w936{margin:2px 0;clear:both;width:936px;/*滑动门的宽度*/}
/* TAB 切换效果 */
.tb_{background-image: url('http://www.codefans.net/jscss/demoimg/200901/tabs1.gif'); background-repeat: repeat-x;background-color: #E6F2FF;}
.tb_ ul{height:24px;}
.tb_ li{float:left;height: 24px;line-height:1.9;width: 94px;cursor:pointer;}
/* 控制显示与隐藏css类 */
.normaltab   { background-image:url('http://www.codefans.net/jscss/demoimg/200901/tabs2.gif'); background-repeat: no-repeat; color:#1F3A87 ;}
.hovertab    { background-image: url('http://www.codefans.net/jscss/demoimg/200901/tabs3.gif'); background-repeat: no-repeat; color:#1F3A87; font-weight:bold }
.dis{display:block;}
.undis{display:none;}
-->
</style>
<script type="text/javascript" language="javascript">
//<!CDATA[
function g(o){return document.getElementById(o);}
function HoverLi(n){
//如果有N个标签,就将i<=N;
for(var i=1;i<=6;i++){g('tb_'+i).className='normaltab';g('tbc_0'+i).className='undis';}g('tbc_0'+n).className='dis';g('tb_'+n).className='hovertab';
}
//如果要做成点击后再转到请将<li>中的onmouseover 改成 onclick;
//]]>
</script>
</head>
<body>
<div class="w936">
 <div id="tb_" class="tb_">
   <ul>
    <li id="tb_1" class="hovertab" onmouseover="x:HoverLi(1);">
    ASP.NET</li>
    <li id="tb_2" class="normaltab" onmouseover="i:HoverLi(2);">
    MYSQL</li>
    <li id="tb_3" class="normaltab" onmouseover="a:HoverLi(3);">
    DELPHI</li>
    <li id="tb_4" class="normaltab" onmouseover="o:HoverLi(4);">
    VB.NET</li>
    <li id="tb_5" class="normaltab" onmouseover="g:HoverLi(5);">
    JAVA</li>
    <li id="tb_6" class="normaltab" onmouseover="z:HoverLi(6);">
    PHP5</li>
   </ul>
 </div>
 <div class="ctt">
  <div class="dis" id="tbc_01">这里是ASP.NET的相关内容</div>
  <div class="undis" id="tbc_02">这里是MYSQL的相关内容</div>
  <div class="undis" id="tbc_03">这里是DELPHI的相关内容</div>
  <div class="undis" id="tbc_04">这里是VB.NET的相关内容</div>
  <div class="undis" id="tbc_05">这里是JAVA的相关内容</div>
  <div class="undis" id="tbc_06">这里是PHP5的相关内容</b>
  </div>
 </div>
</div>
</body>
</html>
