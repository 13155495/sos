<?php
	
      //这是 工具类,对数据库的 操作。
      class sqlHelper{
      	
      	public $conn;
      	public $dbname=DB_NAME;
      	public $username=DB_USER;
      	public $password=DB_PW;
      	public $host=DB_HOST;
      	
      	public function __construct(){
      		
      		$this->conn=mysql_connect($this->host,$this->username,$this->password);
      		
      		if(!$this->conn)
      		{
      			
      			die("连接失败！".mysql_errno());
      		}
      
      		mysql_select_db($this->dbname);
      		mysql_query("SET NAMES utf8");
      	}

      	public function __destruct() {
                  //print "析构数据库". "\n";
                  //$this->close_connect();
            }
      	
      	
      	 
      	
      	//执行dql语句，返回的是数组
      	public function execute_dql($sql){
      		$arr=array();
                  
      		$res=mysql_query($sql,$this->conn) or die(mysql_error());

      		//把res的数据集导入到数组里面去	
      		while($row=mysql_fetch_assoc($res)){
      		    $arr[]=$row;
      		}
                  
      		mysql_free_result($res);
      		return $arr;
      	}
      	

      	
      	//执行dml语句
      	public function execute_dml($sql){
      	

      	    $dml_sql = mysql_query($sql,$this->conn);
                
      	    if(!$dml_sql){
      	    	return 0;
      	    }else{
      	    	if(mysql_affected_rows($this->conn)>0){
      	    		return 1;//表示执行成功！
      	    	}else{
      	    		return 2;//表示没有行受到影响
      	    	}
      	    }
      	
      	}
      	
      	
      	
      	public function close_connect(){
      		if(!empty($this->conn)){
      			mysql_close($this->conn);
      		}
      	}
      	
   }
