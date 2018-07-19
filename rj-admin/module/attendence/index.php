<?php
$qry="";
$item=array();
@header('Content-type:text/html; charset=utf-8');
mysqli_query($con,"SET NAMES 'utf8'");
  if(isset($_POST['month'])){
//print_r($_POST);exit;
    //echo "select name from coloumn where patt_id=$_POST[patteren]";exit;

    if($_FILES['csv']['name']){
        if($_FILES['csv']['type']=='application/vnd.ms-excel'){
            $handle=fopen($_FILES['csv']['tmp_name'],"r");
            while ($data=fgetcsv($handle)) {
          $item=array();
          //print_r($data);exit;
          $j=1;
          $ccount=count($data);
          for($c=0;$c<$ccount;$c++){
            $item[$j]=mysqli_real_escape_string($con,$data[$c]);
            $j++;
        }




        $day=0;
        if($_POST['month']=='jan' || $_POST['month']=='march' || $_POST['month']=='may' || $_POST['month']=='july' || $_POST['month']=='aug' || $_POST['month']=='oct' || $_POST['month']=='decm' ){
          $day=31;
        }elseif ($_POST['month']=='ap' || $_POST['month']=='june' || $_POST['month']=='sept' || $_POST['month']=='nov' ) {
          $day=30;
        }
        elseif ($_POST['month']=='feb') {
        //echo $_POST['year'];
          if($_POST['year']%2==0){
            $day=29;
          }
          else{
            $day=28;
          }
        }
        $set="";
        $count=count($item);
        for($i=1;$i<=2;$i++){
          if($i==1){
            $set.="`roll`='$item[2]',";
          }
          elseif($i==2){
            $set.="`year`='$item[1]',";
          }
        }
          for($j=1;$j<=$day;$j++){
            if(isset($item[$i])){
              $set.="`s$j`='$item[$i]',";
              $i++;
            }
            else{
              $set.="`s$j`='',";
            }
          }
        //echo $set;
        $set=substr($set,0,-1);
        //echo $day;/*
          $sql="insert into $_POST[month] set $set";
          //echo $sql;exit;
          mysqli_query($con,$sql);


      }
    }
}
  //print_r($item);
  //print_r($item);
          //echo $sql;exit;

        fclose($handle);

        $_SESSION['udata']="Data uploaded successfully";
        header("Location:index.php?mod=attendence&do=see_att");
  }
 ?>
<form class="form-horizontal"  method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label class="col-lg-4 control-label">Select Month</label>
        <div class="col-lg-8">
  <select name="month" class="form-control" onchange="showpatt(this.value)">
    <option value="">Select Month</option>
    <option value="jan">January</option>
    <option value="feb">February</option>
    <option value="march">March</option>
    <option value="ap">April</option>
    <option value="may">May</option>
    <option value="june">June</option>
    <option value="july">July</option>
    <option value="aug">August</option>
    <option value="sept">September</option>
    <option value="oct">October</option>
    <option value="nov">November</option>
    <option value="decm">December</option>
  </select>
</div>
</div>
  <div class="form-group">
      <label class="col-lg-4 control-label">Upload CSV file</label>
        <div class="col-lg-8">

<input type="file" name="csv" >
</div></div>
<div class="form-group">
  <div class="col-lg-8 col-lg-offset-4">
    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">Value</button>
    </div>
</div>
</form>
<script type="text/javascript">
function showpatt(cid) {
  $.ajax({
    url:"module/spr/pattern.php",
    data:"cid="+cid,
    type:"post",
    success:function(e){
      $('#patt').html(e);
    }
  });
}
</script>
