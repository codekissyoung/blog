<?php
   class HttpClient
   {

    /**
	 * 调用接口api
	 * 
	 * @param string $url  url
	 * @param string $method  调用方式（post,get）
	 * @param string $paramDic 请求参数
	 */
   	   function Request($url,$method, $paramDic)
   	   {
   	    	   
        $ch = curl_init();       
       // curl_setopt($ch,CURLOPT_PROXY,"http://127.0.0.1:8888");  //指向本地的代理
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch , CURLOPT_URL , $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $paramDic);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HEADER, false);
 
        $data = curl_exec($ch);
        
       	if($data){
			curl_close($ch);
			return $data;
		} else { 
			$error = curl_errno($ch);
			curl_close($ch);
			throw new Exception("curl出错，错误码:$error");
		}
   	   	
   	   }
   	   
 	   
   	   
   	 
   	
   	
   }

?>