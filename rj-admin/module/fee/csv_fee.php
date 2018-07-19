<?php
$qry="";
$item=array();
@header('Content-type:text/html; charset=utf-8');
mysqli_query($con,"SET NAMES 'utf8'");
  if(isset($_POST['submit'])){
		//echo "hi";
//print_r($_POST);exit;
    //echo "select name from coloumn where patt_id=$_POST[patteren]";exit;

    if($_FILES['csv']['name']){
			//echo "hii";
/*      $ext=explode('.',$_FILES['csv']['name']);
      if($ext[1]=='csv'){
      */
      if($_FILES['csv']['type']=='application/vnd.ms-excel'){
				//echo "hiii";
				$i=1;
        $handle=fopen($_FILES['csv']['tmp_name'],"r");
				//echo count($handle);exit;
        while ($data=fgetcsv($handle)) {
					//echo "hiiii";
          //print_r($data);
          // $item=array();
          $j=0;
          $ccount=count($data);
					//print_r($data);
					//echo $ccount;exit;
          for($c=0;$c<$ccount;$c++){

            $item[$j]=mysqli_real_escape_string($con,$data[$c]);
            $j++;
        }
      	//print_r($item);
      	//echo $item[0];
      	$set="";
      	$count=count($item);
      	for($j=0;$j<$count;$j++){
      			//echo "hi";
      			//echo $item[0];

      			$set.="'$item[$j]',";}
      			$set=substr($set,0,-1);
      			//echo $day;/*
						//echo "insert into fees_submit values('',$set)";
      				$sql="insert into fees_submit values('',$set)";
      				echo $sql;
      				mysqli_query($con,$sql);

      }
			$_SESSION['udata']="Data uploaded successfully";
			header("location:index.php?mod=fee&do=see_all_fee");
    }
  }
}?>
<form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
	<div class="col-lg-12">
                <div class="form-group">
                	<label class="col-lg-4 control-label">Upload CSV file for<br />New Student Fee</label>
                    <div class="col-lg-8">
                    <input type="file" class="form-control" id="" name="csv" value="">
                    </div>
                </div>

                <div class="form-group">
                <label class="col-lg-4 control-label">&nbsp;</label>
                    <div class="col-lg-8" align="left">

                    </div>
                </div>

      <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit" name="submit" id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
     </div>
</form>
