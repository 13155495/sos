<?php
require 't.php';
    $pushObj = new Jpush();  
    //组装需要的参数  
    $receive = 'all';     //全部  
    //$receive = array('tag'=>array('1','2','3'));      //标签  
    //$receive = array('alias'=>array('111'));    //别名  
    $title = $_POST['title'];  
    $content = 'ddd'; 
    //$m_time = '86400';        //离线保留时间  
    $extras = array("versionname"=>'ddd', "versioncode"=>'ddd');   //自定义数组  
    //调用推送,并处理  
    $result = $pushObj->push($receive,$title,$content,$extras,$m_time);  
    if($result){  
        $res_arr = json_decode($result, true);  
        if(isset($res_arr['error'])){   //如果返回了error则证明失败  
            //错误信息 错误码  
            $this->error($res_arr['error']['message'].'：'.$res_arr['error']['code'],U('Jpush/index'));      
        }else{  
            //处理成功的推送......  
            //可执行一系列对应操作~  
            $this->success('推送成功~');  
        }  
    }else{      //接口调用失败或无响应  
        $this->error('接口调用失败或无响应~');  
    }  


?>