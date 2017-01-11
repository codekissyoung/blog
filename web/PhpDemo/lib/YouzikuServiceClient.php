<?php
	 require_once 'HttpClient.php';
	 require_once 'ServiceMethod.php';
	 require_once 'ParamBuilder.php';
	 
   class YouzikuServiceClient
   {
   	 
     
        //api地址
        public $host;

        //用户标识
        public $apiKey;

        // 构造一个YouzikuClient
        public function __construct($apiKey,$host="http://service.youziku.com")
        {
        	   
            if (empty($apiKey)) {
            	
            	throw new Exception("apiKey is null!");
            }
                       
            $this->host=$host;
            $this->apiKey=$apiKey;
            
           
        }
      
        // 请求GetFontFace接口
         function GetFontFace($param)
        {
        	

             $postData=ParamBuilder::GetFontFace($param,$this->apiKey);
             $url= $this->host.ServiceMethod::GetFontface; 
               
             return $this->CommonGetFontFace($postData,$url);
        }
      
       

        // 请求GetWoffBase64StringFontFace接口
         function GetWoffBase64StringFontFace($param)
        {
          
             $postData=ParamBuilder::GetFontFace($param,$this->apiKey);
             $url=$this->host.ServiceMethod::GetWoffBase64StringFontFace;
             
             return $this->CommonGetFontFace($postData,$url);
        }
     
      

        

     
        //多标签生成模式,可传递多个标签和内容一次生成多个@fontface
        function GetBatchFontFace($param)
        {
        	
         $postData = ParamBuilder::GetBatchFontFace($param,$this->apiKey);
         $url=$this->host.ServiceMethod::GetBatchFontFace;
         
         return $this->CommonGetFontFace($postData,$url);
        }

 
        function GetBatchWoffFontFace($param)
        {
        	
         $postData = ParamBuilder::GetBatchFontFace($param,$this->apiKey);
         $url=$this->host.ServiceMethod::GetBatchWoffFontFace;
         
         return $this->CommonGetFontFace($postData,$url);
        }
      
       
      
        //请求 自定义路径接口
         function GetCustomPathBatchWoffWebFont($param)
        {
          $postData = ParamBuilder::GetCustomPathBatchWoffWebFont($param, $this->apiKey);
          $url= $this->host.ServiceMethod::CreateBatchWoffWebFont;
          return $this->CommonGetFontFace($postData,$url);
        }

         function CreateBatchWebFontAsync($param)
        {
          $postData = ParamBuilder::GetCustomPathBatchWoffWebFont($param, $this->apiKey);
          $url= $this->host.ServiceMethod::CreateBatchWebFontAsync;
          return $this->CommonGetFontFace($postData,$url);
        }

       
 
        function CommonGetFontFace($postData,$url) 
        {
             $client=new HttpClient();
             $jsonResult =$client->Request($url,"Post", $postData);
               if (empty($jsonResult)) {
                	throw new Exception("接口响应null或Empty!");
               }
             return json_decode($jsonResult);
               
        }

      


   }

?>