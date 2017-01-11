<?php
   class ParamValidate
    {
      
       static function GetFontFace($param){
       	    if(!is_array($param)){
        		
              throw new Exception("参数错误！");
        	}
        	
        	if(!array_key_exists("accessKey",$param)){
        		
        	  throw new Exception("accessKey is null ！");
        	}
        	
           if(!array_key_exists("content",$param)){
        		
        	  throw new Exception("content is not ！");
        	}
       	
       	
       }
      

      
        /// 验证GetBatchFontFace接口
        static function GetBatchFontFace($param)
        {
            if (empty($param)){
            	
            	throw new Exception("BatchFontFaceParam instance is null!");
            } 
            
            if (count($param)<=0) 
            {
            	throw new Exception("BatchFontFaceParam field Count<=0!");
            }
        }
       

       
        //验证CreateBatchWoffWebFontAsync 自定义路径接口
        static function CreateCustomPathBatchWoffWebFont($param)
        {
            if (empty($param))
            {
            	throw new Exception("BatchCustomPathWoffFontFaceParam instance is null!");
            } 
            if (count($param)  <= 0)
           {
            	 throw new Exception("BatchCustomPathWoffFontFaceParam field Count<=0!");
            		
           }
        }
    
    }	
	
	
	
	
?>