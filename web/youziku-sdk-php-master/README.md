# 一、介绍

## 1．SDK适用语言<br/>
SDK适用于在PHP中调用<a href="http://service.youziku.com">service.youziku.com</a>中的所有api<br/>

## 2. SDK工作流程<br/>
　　①用户用后台程序调用SDK，提交动态内容到有字库的子集化(裁切)服务器<br/>
　　②服务器根据内容裁剪出对应的小字体文件，并转换为4种通用字体格式（woff、eot、ttf、svg）<br/>
　　③服务器将所有字体文件上传至阿里云CDN<br/>
　　④服务器用文件的CDN路径拼出@font-face语句<br/>
　　⑤服务器通过SDK将@font-face语句返回给用户的后台程序<br/>

## 3.@font-face语句<br/>
SDK的返回值主要内容是@font-face语句，@font-face语句是CSS3中的一个功能模块，是所有浏览器天然支持的CSS语句。它的作用是将一个远程字体文件加载到当前页面，并且定义成一个字体，前端页面能够像使用本地字体一样使用该字体。@font-face语句是实现在线字体效果的核心代码。<br/>

## 4. 显示字体效果
用户可以将@font-face语句与内容相对应保存至数据库，以便在内容被加载时，该语句能跟随内容一起加载到前端页面，从而使内容显示字体效果；<br/>
用户也可以不保存@font-face语句：有字库允许用户<a href="#user-content-4自定义路径生成模式">自定义字体存放路径</a>，当需要显示字体效果时，可以根据自己所定义的路径<a href="http://service.youziku.com/index.html#format" target="_blank" style="color: #ff7e00;">拼组出@font-face语句</a>，然后将语句输出到前端页面，即可使内容显示字体效果。

# 二、环境
1.PHP 5.2及以上版本<br />
2.<a href="https://github.com/youziku/youziku-sdk-php/raw/master/sdk/sdk.libs.zip">下载SDK</a><br />
# 三、引用
1.requir_once 'lib/YouzikuServiceClient.php';

# 四、Sample
## 1.初始化YouzikuServiceClient实例,在全局配置一遍即可
```PHP 
$youzikuClient=new YouzikuServiceClient("xxxxxx");//xxxxxx为用户的apikey
```
## 2.单标签模式
### 2.1 getFontface()
#### 备注:直接返回所有格式的@fontface

``` PHP
//accessKey是字体的accesskey;content是要生成效果的文字内容;tag是css选择器代码
$param=array("accessKey"=>"xxx","content"=>"有字库，让中文跃上云端！","tag"=>"#id1,.class1");
$response=$youzikuClient->GetFontFace($param);
```
### 2.2 getWoffBase64StringFontFace()
#### 备注：直接返回流（woff流）的@fontface

``` PHP
$param=array("accessKey"=>"xxx","content"=>"有字库，让中文跃上云端！","tag"=>"#id1,.class1");
$response=$youzikuClient->GetWoffBase64StringFontFace($param); 
```

## 3.多标签生成模式
### 1.getBatchFontFace()
#### 备注：直接返回所有格式的@fontface;可传递多个标签和内容一次生成多个@fontface

``` PHP
$params[0]=array("accessKey"=>"xxx","content"=>"有字库，让中文跃上云端！","tag"=>"#id1,.class1");
$params[1]=array("accessKey"=>"xxx","content"=>"有字库，让前端掌控字体！","tag"=>"h1,div");

$response = $youzikuClient->GetBatchFontFace($params);
```

### 2.getBatchWoffFontFace ()
#### 备注：直接返回仅woff格式的@fontface

``` PHP
$params[0]=array("accessKey"=>"xxx","content"=>"有字库，让中文跃上云端！","tag"=>"#id1,.class1");
$params[1]=array("accessKey"=>"xxx","content"=>"有字库，让前端掌控字体！","tag"=>"h1,div");

$response = $youzikuClient->GetBatchWoffFontFace($params);
```

## 4.自定义路径生成模式
### 1.CreateBatchWoffWebFontAsync()
#### 备注：自定义路径接口可以被程序异步调用，程序调用后可以直接向下执行，不需要等待返回值
#### &emsp;&emsp;当需要显示字体效果时，可以根据自己所定义的路径<a href="http://service.youziku.com/index.html#format" target="_blank" style="color: #ff7e00;">拼组出@font-face语句</a>，然后将语句输出到前端页面，即可使内容显示字体效果。
``` PHP
$cusParams[0]=array("accessKey"=>"xxx","content"=>"有字库，让中文跃上云端！","url" => "youziku/test-1");
$cusParams[1]=array("accessKey"=>"xxx","content"=>"有字库，让前端掌控字体！","url" => "youziku/test-2";

$response =  $youzikuClient->GetCustomPathBatchWoffWebFont($cusParams);
```
