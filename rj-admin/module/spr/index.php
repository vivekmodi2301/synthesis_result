<?php
$qry="";
$item=array();
@header('Content-type:text/html; charset=utf-8');
mysqli_query($con,"SET NAMES 'utf8'");
  if(isset($_POST['class'])){

    //echo "select name from coloumn where patt_id=$_POST[patteren]";exit;
    if($_POST['pattern']){
      $pdata=fetchAll("select coloumn.name from coloumn  where patt_id=$_POST[pattern] order by sequence");
      //print_r($pdata);
      foreach ($pdata as  $value) {
        $ddata[]=$value['name'];
      }
      //print_r($ddata);exit;
      $tname=fetchOne("select tname from patteren where id=$_POST[pattern] ");
      extract($tname);
      $select=strtolower($tname);
    }
    $test=0;
    $last_test_id=fetchOne("select test from $tname order by test desc");
    if($last_test_id)extract($last_test_id);
    $test=$test+1;
    if($_FILES['csv']['name']){
/*      $ext=explode('.',$_FILES['csv']['name']);
      if($ext[1]=='csv'){
      */
      if($_FILES['csv']['type']=='application/vnd.ms-excel'){
        $handle=fopen($_FILES['csv']['tmp_name'],"r");
    //    $i=0;
        while ($data=fgetcsv($handle)) {

          $qry="";
          $item=array();
          $ccount=count($data);
          for($c=0;$c<$ccount;$c++){
            $item[]=mysqli_real_escape_string($con,$data[$c]);
        }
        //print_r($item);
//print_r($item);
      $qry.="`exam_date`='$item[0]' , `roll`='$item[1]' ,";
        for($i=0;$i<$ccount-2;$i++){
            //print_r($pdata);
            //$qry="";
            $count=count($pdata);
            //echo $count;
            //print_r($pdata);
            $ij=$i+2;
              $qry.="`$ddata[$i]`='$item[$ij]' ,";

              //echo $qry;

            //echo $qry;exit;
          }
          //echo $qry;
          //echo $qry;
          //$qry=substr($qry,0,-1);

          $qry.="test=".$test;
          $sql="insert into $select set $qry";
          //echo $sql;exit;
          mysqli_query($con,$sql);
          //$i++;
        }
        fclose($handle);
        $_SESSION['data']="Data uploaded successfully";
        header("Location:index.php?mod=spr&do=see_spr");
      }
    }
  }
 ?>
 <?php
 //print_r($_SESSION);
 ?>
<form class="form-horizontal"  method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label class="col-lg-4 control-label">Select Class</label>
        <div class="col-lg-8">
  <select name="class" class="form-control" onchange="showpatt(this.value)">
    <option value="">Select Class</option>
    <?php
                  $class_data=fetchAll("select id,name from class");
                  foreach($class_data as $class_data){
                  ?>
                                  <option value="<?php echo $class_data['id'];?>"><?php echo $class_data['name'];?></option>
                                <?php
                  }
                ?>
  </select>
          </div>
      </div>
      <div class="form-group">
          <label class="col-lg-4 control-label">Select Patteren</label>
            <div class="col-lg-8">

  <select name="pattern" id="patt" class="form-control" >
    <option value="">Select Pattern</option>
  </select></div></div>

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
