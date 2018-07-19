<?php
session_start();
$pageData="10";
//print_r($_POST);
$roll="";
$datee="";
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
  include_once($phpfile);
}
//print_r($_GET);
//print_r($_POST);
  extract($_POST);
  extract($_GET);
  $spattern=$pattern;
   $qry="select name,tname from patteren where id=$pattern";
    //echo "select name from patteren where id=$pattern";

    //echo $qry;
    $patteren=fetchOne($qry);//exit;
    extract($patteren);
  $name=strtolower($tname);
  $setable=$name."_".$class;
  //print_r($_GET);
  if(isset($_POST['where'])){
  	$wh=$_POST['where'];
  }else{
  $wh=" where 1 ";
  if($roll){
    $wh.=" and $tname.roll like'$roll%' ";
  }
  
  if($s_name){
    $wh.=" and s_name like'$s_name%' ";
  }
  if($datee){
    $wh.=" and `exam_date` like '$datee%' ";
  }

	if(isset($nod) && $nod){
		$pageData=$nod;
	}
	}
  //echo $wh;
?>
<?php
    $col=array();
    $qry="select name,tname from patteren where id=$pattern";
    //echo "select name,tname from patteren where id=$pattern";

    //echo $qry;
    $patteren=fetchOne($qry);//exit;
    extract($patteren);
    $qry="select name from coloumn where patt_id=$pattern order by sequence";
    $coloumn=fetchAll($qry);//exit;
    //print_r($coloumn);
    $tot=count($coloumn);
?>
 <div class="col-lg-12 table-resposive" style="margin-left:10px; font-family:'Century Gothic';">
    <table class="table table-bordered table-hover" id="spr_table">
             <tr class="active1 table_style" style="font-weight:600;">
                   <td width="50">Sr. No.</td>
                   <td>Roll No.</td>
                   <td>Student Name</td>
                   <td>Batch</td>
                   <td>Exam Date</td>
              
                   <?php
                   //print_r($coloumn);?>
                   <?php foreach ($coloumn as $value) {
                     $col[]=$value['name'];?>
                     <td width="80"><?php echo $value['name'];?></td>
                   <?php }
                   //print_r($col);
                   $ecol=implode('`,`',$col);?>
                   <!--<td width="80">View Full Profile</td>-->
                   <td width="50" colspan="2">Action</td>
               </tr>
               <?php
                 $sno=1;

                 	$url="module/spr/show_stu_result.php?class=".$class."&pattern=".$pattern;
                 	$limit=1;
                 	$frmdataget=$_REQUEST;
                 	@PaginationWork($pageData);
                 	$table=strtolower($name);
                 	$totRslt=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as tot from ".$tname." join student_biodata on $tname.roll=student_biodata.roll ".$wh));
                 	//echo "select count(*) as tot from ".$tname." join student_biodata on $tname.roll=student_biodata.roll ".$wh;
                 	//echo "select count(*) as tot from ".$tname." join student_biodata on $tname.roll=student_biodata.roll ".$wh;
                 	//echo "select count(*) as tot from ".$table.$wh;exit;
                 	//echo "select count(*) as tot FROM student_biodata  join batch on batch=batch.id  join fees_submit on student_id=student_biodata.id join class on class=class.id $wh GROUP by student_biodata.id order by student_biodata.id ";
                 	
                 	$rs=mysqli_query($con,"select $tname.roll,s_name,`exam_date`,$tname.id,`$ecol` from ".$tname." join student_biodata on $tname.roll=student_biodata.roll".$wh." limit ".$frmdata['from'].", ".$frmdata['to']);
                 	//echo "select $table.roll,s_name,`exam_date`,$table.id,`$ecol` from ".$table." join student_biodata on $table.roll=student_biodata.roll".$wh." limit ".$frmdata['from'].", ".$frmdata['to'];//exit;
                 	$tablename=strtolower($name)."_".$class;
                 	//echo "select `roll`,`exam_date`,id,`$ecol` from ".strtolower($name)."_".$class.$wh." limit ".$frmdata['from'].", ".$frmdata['to'];//exit;
                 	//echo "select id,`$ecol` from ".strtolower($name)."_".$class.$wh." limit ".$frmdata['from'].", ".$frmdata['to'];
                 	//echo "SELECT student_biodata.id,class.name as class,roll,s_name,f_name,batch.name as name,propic,total_fees,fee_disc,sum(fee_submit) as submit FROM student_biodata  join batch on batch=batch.id  join fees_submit on student_id=student_biodata.id join class on class=class.id $wh GROUP by student_biodata.id order by student_biodata.id limit  ".$frmdata['from'].", ".$frmdata['to'];
                 	$total_row=$totRslt['tot'];
                 //$patt_detail=fetchAll("select id,`$ecol` from ".$name."_".$class.$wh);

                 //echo "select `$ecol` from ".$name."_".$class.$wh;//exit;
                 //echo "select $ecol from ".$class."_".$class;
                 //echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id";
                 while($patt_detail=mysqli_fetch_assoc($rs)) {
                ?>
               <tr class="primary1 table_style2">
                   <td><?php echo $sno++;?></td>
                   <td><?php echo $patt_detail['roll'];?></td>
                   <?php
                   	$s_name=fetchOne("select s_name,batch.name as batch from student_biodata join batch on batch=batch.id where roll=$patt_detail[roll]");
                   ?>
                   
                   <td><?php  echo $s_name['s_name'];?></td>
                   <td><?php echo $s_name['batch'];?></td>
                   <td><?php echo $patt_detail['exam_date'];?></td>
                   <?php $col_count=count($col);
                   for($d=0;$d<$col_count;$d++){?>
                     <td><?php echo $patt_detail[$col[$d]];?></td>
                   <?php }?>
                   <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
                   <td><a href="index.php?mod=spr&do=edit_spr&id=<?php echo $patt_detail['id'];?>&table=<?php echo $tname;?>" title="Edit Profile"><img src=<?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a> &nbsp; &nbsp;| &nbsp;&nbsp;<a href="#" onclick="del('<?php echo $patt_detail['id'];?>','<?php echo $tablename;?>')">Delete</a>&nbsp; &nbsp;| &nbsp;&nbsp;
                    <a href="index.php?mod=spr&do=summary&id=<?php echo $patt_detail['roll'];?>">Detail</a></td>
               </tr>
               <?php }?>

               <tr>
               		<td colspan="20">
               			<?php searchPaginationDisplay($total_row,$url.'&pageNumber=','',$pageData,$wh,$class, $pattern);?>
               		</td>
               </tr>
           </table>
<script>
	function del(id,table){
		if(confirm("Do you want to delter this record")){
			location.href="index.php?mod=spr&do=show_spr&id="+id+"&table="+table;
		}
	}
</script>