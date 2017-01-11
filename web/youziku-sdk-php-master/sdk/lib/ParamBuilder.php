<?php
	
	require_once 'ParamValidate.php';
	
  /**
  * 	构建请求参数
  */
    class ParamBuilder
    {
       
     /**
	 * 构建GetFontFace 请求的参数
	 * @param array $param 需要请求字体信息
	 * @param string $apiKey 用户标识
	 * @return string 请求参数
	 */
        static function GetFontFace($param,$apiKey){
           
           ParamValidate::GetFontFace($param);
           $param["content"]=str_replace("&","",$param["content"]);
           $paramDic = array("ApiKey"=>$apiKey,"AccessKey"=>$param["accessKey"],"Content"=>$param["content"],"Tag"=>$param["tag"]);
           $postData=self::ToUrlParams($paramDic);
           return $postData;
        	
        }
       
    /**
	 * 构建GetBatchFontFace 请求的参数
	 * @param array $param 需要请求字体信息
	 * @param string $apiKey 用户标识
	 * @return string 请求参数
	 */
        static function GetBatchFontFace($param,$apiKey)
        {
            
            ParamValidate::GetBatchFontFace($param);
            
            $str="ApiKey=".$apiKey."&";
         
            for ($i = 0; $i <count($param); $i++)
            {
                
              $str.="Tags[".$i."][AccessKey]=".$param[$i]["accessKey"]."&";
              $str.="Tags[".$i."][Tag]=".$param[$i]["tag"]."&";
              $param[$i]["content"]=str_replace("&","",$param[$i]["content"]);
              $str.="Tags[".$i."][Content]=".$param[$i]["content"]."&";
              
            }
             $str=trim($str,"&");
           
            return $str;
            
        }
      
    /**
	 * 构建GetCustomPathBatchWoffWebFont 请求的参数
	 * @param array $param 需要请求字体信息
	 * @param string $apiKey 用户标识
	 * @return string 请求参数
	 */
        static function GetCustomPathBatchWoffWebFont($param,$apiKey)
        {
            ParamValidate::CreateCustomPathBatchWoffWebFont($param);
          
             $paramDic["ApiKey"]=$apiKey;

            for ($i = 0; $i <count($param); $i++)
            {
             
             $paramDic["Datas[".$i."][AccessKey]"]=$param[$i]["accessKey"];
             $paramDic["Datas[".$i."][Url]"]=$param[$i]["url"];

             $param[$i]["content"]=str_replace("&","",$param[$i]["content"]);
             $paramDic["Datas[".$i."][Content]"]=$param[$i]["content"];
            }
            
             $postData=self::ToUrlParams($paramDic);

            return $postData;
        }
        
     /**
	 * 把数组转成请求参数形式
	 * @param array $paramDic 请求参数数组
	 * @return string 请求参数字符串
	 */
     static function ToUrlParams($paramDic)
	  {
		$buff = "";
		foreach($paramDic as $k => $v)
		{
			if($v != "" && !is_array($v)){
				$buff .= $k . "=" . $v . "&";
			}
		}
		
		$buff = trim($buff, "&");
		
		return $buff;
	   }
       
    }	
	
	
?>