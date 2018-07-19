<?php
session_start();
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
  include_once($phpfile);
}?>
<?php
  extract($_POST);
  $wh=" where 1 ";
  if($datee){
    $wh.=" and `exam_date` like '$datee%'";
  }
    $col=array();
    $pattern=$patt;
       //$tname=strtolower($tname);
    $qry="select name from coloumn where patt_id=$pattern order by sequence";
    //echo $qry;
    //$coloumn=fetchAll($qry);//exit;
    //$tot=count($coloumn);
?>
<table class="table table-bordered table-hover" >
  <tr class="active1 table_style" style="font-weight:600;">
    <td width="50">Sr. No.</td>
    <td>Exam Date</td>
<!--<td width="80">View Full Profile</td>-->
    <td>Action</td>
  </tr>
  <?php
    $sno=1;
    $patt_detail=fetchAll("select test,`exam_date` from ".$tname." $wh group by `exam_date`");
    //echo "<tr><td>select test,`exam_date` from ".$tname." $wh group by `exam_date`</td></tr>";exit;
    //echo "select id,`Exam_Date` from ".$patteren['tname']." gorup by test";
    //echo "select $ecol from ".$class."_".$class;
    //echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id";
    foreach ($patt_detail as  $patt_detail) {
    ?>
      <tr class="primary1 table_style2">
        <td><?php echo $sno++;?></td>
        <td><?php echo $patt_detail['exam_date'];?></td>
        <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
        <td><a href="#" onclick="del('<?php echo $patt_detail['exam_date'];?>','<?php echo $tname;?>')" title="Edit Profile">Delete</a></td>
      </tr>
   <?php }?>
 </table>