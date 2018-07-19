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
	function changeColoumn($qry)
	{
		echo $qry;exit;
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		mysqli_query($con,$qry);
	}
	function laddUpdate($table,$data,$f_id=""){
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
		return mysqli_insert_id($con);
	}
	function create_table($qry){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		mysqli_query($con,$qry);
	}
	function fetchAll($sql)
	{
		//echo $sql;//exit;
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
			//echo $sql;
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
			//echo $sql;exit;
			mysqli_query($con,$sql);


			}
			function dropTable($table){
				$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
				mysqli_query($con,"drop table $table");
				//echo "drop table $table";exit;
			}
			function addcoloumn($qry){
				$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
				mysqli_query($con,$qry);
			}
			function dropcoloumn($qry){
				$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
				mysqli_query($con,$qry);
			}
			function PaginationWork($pno='')
		{
			 global $frmdata ;
			 global $frmdataget;
				$recordPerPage=10	;
			 if($pno)
				 $recordPerPage=$pno;

			 $frmdata['to']=$recordPerPage;
			 if($frmdataget['pageNumber']<=1)
			 {
				 $frmdataget['pageNumber']=1;
					 $frmdata['from']=0;
				 }
			 else
						$frmdata['from']= $recordPerPage * ( ( (int) $frmdataget['pageNumber']) - 1);

		}
		function PaginationDisplay(&$totalCount,$starturl,$endurl,$pno='')
		{
			//echo "hi";
						global  $frmdata;
						global $frmdataget;
						//print_r($frmdata);
						//print_r($frmdataget);
				$recordPerPage=10;
				if($pno)
				 $recordPerPage=$pno;

				if($totalCount > $recordPerPage)
						{
								echo '<span id="pg">';
								$pre=$frmdataget['pageNumber']-1;
								if($frmdata['from'] >0)
								{
										echo '<a href="'.$starturl.$pre.$endurl.'" >&lt;Prev</a>';
								}
								$i=1;
								$j=$frmdataget['pageNumber'];
								if($j>=10)
								$i=$j-4;
								if($totalCount > 2* $recordPerPage)
								{
										for(;$i<=5+$frmdataget['pageNumber'] &&($totalCount >($i-1)*$recordPerPage) ;$i++)
										{
												if($i==$frmdataget['pageNumber'])
												{
														echo '<a id="pg-selected">';
														echo ($i);
														echo '</a>';
												}
												else
												{
														echo '<a href="'.$starturl.$i.$endurl.'">';
														echo ($i);
														echo '</a>';
												}
										}
								}
								$frmdataget['pageNumber']=$j;
								$next=$frmdataget['pageNumber']+1;
								if($totalCount > ($frmdata['from'] + $frmdata['to']))
								{
										echo '<a href="'.$starturl.$next.$endurl.'" >&gt;Next</a>';
								}
								echo '</span>';
					}
		}


		function searchPaginationDisplay(&$totalCount,$starturl,$endurl,$pno='',$wh,$class='',$pattern='')
		{
						global $frmdata;
						global $frmdataget;
						$wh=addslashes($wh);
				$recordPerPage=10;
				if($pno)
				 $recordPerPage=$pno;

				if($totalCount > $recordPerPage)
						{
								echo '<span id="pg">';
								$pre=$frmdataget['pageNumber']-1;
								if($frmdata['from'] >0)
								{
										?><a href="#" onClick="showpage('<?php echo $wh;?>','<?php echo $pre;?>', '<?php echo $class;?>','<?php echo $pattern;?>')"><?php echo '&lt;Prev</a>';
								}
								$i=1;
								$j=$frmdataget['pageNumber'];
								if($j>=10)
								$i=$j-4;
								if($totalCount > 2* $recordPerPage)
								{
										for(;$i<=5+$frmdataget['pageNumber'] &&($totalCount >($i-1)*$recordPerPage) ;$i++)
										{
												if($i==$frmdataget['pageNumber'])
												{
														echo '<a id="pg-selected">';
														echo ($i);
														echo '</a>';
												}
												else
												{
														?><a href='#' onClick="showpage('<?php echo $wh;?>','<?php echo $i;?>','<?php echo $class;?>','<?php echo $pattern;?>')"><?php
														echo ($i);
														echo '</a>';
												}
										}
								}
								$frmdataget['pageNumber']=$j;
								$next=$frmdataget['pageNumber']+1;
								if($totalCount > ($frmdata['from'] + $frmdata['to']))
								{
										?><a href="#" onClick="showpage('<?php echo $wh;?>','<?php echo $next;?>', '<?php echo $class;?>','<?php echo $pattern;?>')"><?php echo '&gt;Next</a>';
								}
								echo '</span>';
					}
		}
?>
