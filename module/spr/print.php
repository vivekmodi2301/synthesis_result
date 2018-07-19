<?php
session_start();
ob_start();
 date_default_timezone_set('Asia/Kolkata');
 $phpfiles=glob("../../include/php/*.php");
 foreach($phpfiles as $phpfile){
  include_once($phpfile);
 }
//print_r($_SESSION);exit;
$uid=$_SESSION['udetail']['id'];
$uroll=$_SESSION['udetail']['roll'];
  $stu_detail=fetchOne("select class.id as classid,s_name,f_name,class.name as class,batch.name as batch from student_biodata join class on class=class.id join batch on batch=batch.id where student_biodata.id=$uid");
  if($stu_detail){
  //echo "select student_biodata.id,s_name,f_name,class.name as class from student_biodata join class on class=class.id where student_biodata.id=$uid";
 ?>
 <link rel="stylesheet" href=<?php echo ROOT."css/bootstrap.min.css";?>>
  <link rel="stylesheet" href=<?php echo ROOT."css/bootstrap-theme.min.css";?>/>
  <link rel="stylesheet" href=<?php echo ROOT."css/style2.css";?>/>
  
    <div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-8 container-fluid">
    <button onClick="printme()" class="btn btn-danger btn-sm btn-block">Print</button>
    <div class="col-lg-12 text_setting table-responsive" style="padding-left:0px;">
    <table class="table table-bordered text-capitalize table-hover" style="text-align:left;">
    <a href="#"><img src="../../header_print.png" class="img-responsive" width="100%" height="250px"/></a>
        <tr>
          <td colspan="1">Roll No.</td>
          <td colspan="3"><?php echo $_SESSION['udetail']['roll'];?></td>
        </tr>
        <tr>
          <td>Student Name</td>
          <td><?php echo $stu_detail['s_name'];?></td>
          <td>Father Name</td>
          <td><?php echo $stu_detail['f_name'];?></td>
        </tr>
        <tr>
          <td>Class</td>
          <td><?php echo $stu_detail['class'];?></td>
          <td>Batch</td>
          <td><?php echo $stu_detail['batch'];?></td>
        </tr>
        </table>
<?php
  $patt=fetchAll("select id,name,tname from patteren where class_id=$stu_detail[classid]");
  //print_r($patt);
  foreach ($patt as $patt) {
  $tname=$patt['tname'];
  $tname=strtolower($tname);
    $total=0;
    $tot_test=0;
    $col=fetchAll("select name from coloumn where patt_id=$patt[id] order by sequence");
    $count=count($col);
    //print_r($col);
?>
        <table class="table table-bordered text-capitalize table-hover" style="text-align:center;">
        <tr class="text_setting_bold" style="font-weight:bold;">
          <td colspan="<?php echo $count;?>">: : <?php echo $patt['name'];?> PATTERN : :</td>
        </tr>

        <tr>
        <td>Exam Date</td>
          <?php $colname=array(); foreach ($col  as $ecol) { if($ecol['name']=='ROLL' || $ecol['name']=='roll'){continue;} $colname[]=$ecol['name'];?>
          <td width="150"><?php echo $ecol['name'];?></td>
          <?php } //print_r($colname);?>
        </tr>
        <?php $select_coloumn=implode('`,`',$colname);//echo $select_coloumn;
        //echo "select $select_coloumn from $patt[tname] where roll=$uroll";
        strtolower($patt['tname']);
          $rdata=fetchAll("select `exam_date`, `$select_coloumn` from $tname where roll=$uroll group by STR_TO_DATE(exam_date,'%d.%m.%Y') order by STR_TO_DATE(exam_date,'%d.%m.%Y')");
//echo "select `$select_coloumn` from $tname where roll=$uroll";
//echo "select `exam_date`, `$select_coloumn` from $tname where roll=$uroll";//exit;
//echo "select `$select_coloumn` from $patt[tname] where Roll No.=$uroll";exit;
          $tot_test=count($rdata);
          foreach ($rdata as $rdata) {
            if($rdata){
        ?>
        <tr>
        <td><?php echo $rdata['exam_date'];?></td>
          <?php $ccount=count($colname);
          for($d=0;$d<$ccount;$d++){?>
            <td width="150"><?php   if($colname[$d]=='%'){$total+=$rdata[$colname[$d]];} echo $rdata[$colname[$d]];?></td>
          <?php }?>
        </tr>
        <?php }else{
          echo "<td colspan='20'>No data found</td>";
        }}?>
        <?php if($tot_test){?>
        <tr>
          <td width="150">AVG %</td>
          <td colspan="<?php echo $count-1;?>" style="text-align:right; padding-right:4%;"><?php echo sprintf ("%.2f",$total/$tot_test);?></td>
        </tr>
        <?php }else{
          echo "<td colspan='20'>No data found</td>";
        }}?>

</table>
    </div>
<?php }?></div><div class="col-lg-2">&nbsp;</div>
<script type="text/javascript">
  function printme(){
    window.print();
  }
</script>