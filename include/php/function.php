<?php
	$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
	function addUpdate($table,$data,$f_id=""){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="insert into $table set ";
		$wh="";
		if($f_id){
			$qry="update $table set ";
			$wh=" where id=$f_id";
		}
		//print_r($data);
		foreach($data as $key=>$value){
			$qry.="`$key`='". addslashes($value)."' ,";
		}
		$qry=substr($qry,0,-1).$wh;
		//echo $qry;exit;
		mysqli_query($con,$qry);
	}
	function fetchAll($sql)
	{
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);

		$alldata=array();
		$rs=mysqli_query($con,$sql);
		$dt=array();
		while(($dt=mysqli_fetch_assoc($rs))?$alldata[]=array_map('stripslashes',$dt):false);
		return $alldata;
		}
		function fetchOne($sql)
		{

			$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
			$rs=mysqli_query($con,$sql);
			if(mysqli_num_rows($rs)){
				($dt=mysqli_fetch_assoc($rs))? $dt= array_map('stripslashes',$dt): $dt= false;
				//print_r($dt);exit;
			 	return $dt;
			}
			else {
				return $dt="";
			}
		}
		function fetchRow($sql)
		{
			$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
			$rs=mysqli_query($con,$sql);


		 	return mysqli_num_rows($rs);
		}

		function delete($table,$id)
		{
			$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
			$sql="delete from $table where id=$id";
			mysqli_query($con,$sql);


			}
?>
