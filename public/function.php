<?php

	

	/*
	 * 提取提交的参数
	 * $k是数组下标 
	 * $var是表示  PHP全局变量
	 * G--_GET
	 * P--_POST
	 * C--_COOKIE
	 * R--_REQUEST
	 */
	function getgpc($k, $var = 'R')
	{
	    switch($var)
	    {
	        case 'G':
				$var = &$_GET;
				break;
	        case 'P':
				$var = &$_POST;
			    break;
	        case 'C': 
				$var = &$_COOKIE;
			    break;
	        case 'R':
				$var = &$_REQUEST;
			    break;
	    }
	    return isset($var[$k]) ? $var[$k] : NULL;
	}
	/*
		数组中往头部添加一个元素
		二维数组会遍历在每个一维数组中加
		
	*/
	function array_add($des,$add)
	{
		$count = count($des);
		
		foreach ($des as $value)	
		{
			$arr_ = $add + $value;
			$arr[] = $arr_ + $arr_;
		}
		//一个元素
		if($count == 1)
		{
			return $arr_;
		}
		//多个元素
		else
		{
			
			return $arr;
		}
	}
	

	function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
	{
	    static $recursive_counter = 0;
	    if (++$recursive_counter > 1000) {
	        die('possible deep recursion attack');
	    }
	    foreach ($array as $key => $value) {
	        if (is_array($value)) {
	            arrayRecursive($array[$key], $function, $apply_to_keys_also);
	        } else {
	            $array[$key] = $function($value);
	        }
	         
	        if ($apply_to_keys_also && is_string($key)) {
	            $new_key = $function($key);
	            if ($new_key != $key) {
	                $array[$new_key] = $array[$key];
	                unset($array[$key]);
	            }
	        }
	    }
	    $recursive_counter--;
	}

	function JSON($array) {
	    arrayRecursive($array, 'urlencode', true);
	    $json = json_encode($array);
	    return urldecode($json);
	}
	
	
?>