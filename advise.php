<?php  
	require_once 'class/Advise.class.php';	

    $id 		= getgpc('id', 'G');
    $content 	= getgpc('content', 'G');

    if ($id == '' || $content =='')
	{
	
		die( JSON(array('res' =>0, 'data' => 'required parameter missing')));	
	}
	
	//建议添加
	$advise = new Advise();

	$res = $advise->checkId($id);
	if(!$res)
	{
		die( JSON(array('res' =>0, 'data' => 'user is not exist')));
	}
	else
	{
		$res  = $advise->addContent($id,$content);
		if($res)
		{
			die( JSON(array('res' =>1, 'data' => 'sucess')));
		}
		else
		{
			die( JSON(array('res' =>0, 'data' => 'fail')));
		}
	}


?>