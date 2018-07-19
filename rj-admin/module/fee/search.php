<?php
session_start();
	$total_fees_recived=0;
	$total_fees=0;
	$total_remain_fee=0;
	$pageData="10";
 ?>
<?php

$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
  include_once($phpfile);
}
//print_r($_POST);
  extract($_POST);
	if(isset($wh)){
  $wh="where 1 ";
	if($wh)
  if($roll){
    $wh.=" and fees_submit.roll like'$roll%' ";
  }
  if($sname){
    $wh.=" and s_name like '$sname%' ";
  }
  if($fname){
    $wh.=" and f_name like '$fname%' ";
  }
  if($classs){
    $wh.=" and class='$classs' ";
  }
  if($batch){
    $wh.=" and batch='$batch' ";
  }  $_SESSION['wh']=$wh;
  }else{
    $wh=$_SESSION['wh'];
		//unset($_SESSION['wh']);
  }
  //echo $wh;
	if(isset($nod) && $nod){
		$pageData=$nod;
	}
	?>

	<?php

	$url="module/fee/search.php?abc=abc";
	$limit=1;
	$frmdataget=$_REQUEST;
	@PaginationWork($pageData);
	$totRslt=mysqli_query($con,"select count(*) as tot FROM student_biodata  join batch on batch=batch.id  join fees_submit on fees_submit.ROLL=student_biodata.roll join class on class=class.id $wh GROUP by student_biodata.id order by student_biodata.id");
	//echo "select count(*) as tot FROM student_biodata  join batch on batch=batch.id  join fees_submit on student_id=student_biodata.id join class on class=class.id $wh GROUP by student_biodata.id order by student_biodata.id ";
	$rs=mysqli_query($con,"SELECT student_biodata.id,class.name as class,student_biodata.roll,s_name,f_name,batch.name as name,propic,total_fees,fee_disc,sum(fee_submit) as submit FROM student_biodata  join batch on batch=batch.id  join fees_submit on fees_submit.ROLL=student_biodata.roll join class on class=class.id $wh GROUP by student_biodata.id order by student_biodata.id limit  ".$frmdata['from'].", ".$frmdata['to']);
	//echo "SELECT student_biodata.id,class.name as class,student_biodata.roll,s_name,f_name,batch.name as name,propic,total_fees,fee_disc,sum(fee_submit) as submit FROM student_biodata  join batch on batch=batch.id  join fees_submit on fees_submit.ROLL=student_biodata.roll join class on class=class.id $wh GROUP by student_biodata.id order by student_biodata.id limit  ".$frmdata['from'].", ".$frmdata['to'];

	//echo "SELECT student_biodata.id,class.name as class,roll,s_name,f_name,batch.name as name,propic,total_fees,fee_disc,sum(fee_submit) as submit FROM student_biodata  join batch on batch=batch.id  join fees_submit on student_id=student_biodata.id join class on class=class.id $wh GROUP by student_biodata.id order by student_biodata.id limit  ".$frmdata['from'].", ".$frmdata['to'];
	$total_row=mysqli_num_rows($totRslt);
//echo $wh;
	?>
<table class="table table-bordered table-hover">
	<tr>
			<td colspan="15"><span style="color:#900; font-weight:bold;">Total Students in this section : <?php echo $total_row;?></span></td>
	</tr>
<tr class="active1 table_style" style="font-weight:600;">
    <td width="50">Sr. No.</td>
    <td width="80">Roll No.</td>
    <td width="150">Student Name</td>
    <td width="150">Father Name</td>
    <td width="50">Class</td>
    <td width="50">Batch</td>
    <td width="70">Total Fee</td>
    <td width="70">Fee Deposit</td>
    <td width="70">Fee Due</td>
    <td width="70">Total Installment</td>
    <td width="80">Photo</td>
    <td width="50">Action</td>
    <!--<td width="80">View Full Profile</td>-->
</tr>
<?php
$sno=1;
  while($fee_detail=mysqli_fetch_assoc($rs)) {
		if($fee_detail['propic']){
			$propic="images/student_images/".$fee_detail['propic'];
		}else{
			$propic="images/view.gif";
		}
?>
<tr class="primary1 table_style2">
    <td><?php echo $sno++;?></td>
    <td><?php echo $fee_detail['roll'];?></td>
    <td><?php echo $fee_detail['s_name'];?></td>
    <td><?php echo $fee_detail['f_name'];?></td>
    <td><?php echo $fee_detail['class'];?></td>
    <td><?php echo $fee_detail['name'];?></td>
    <td><?php  $detail=$fee_detail['total_fees']-$fee_detail['total_fees']*$fee_detail['fee_disc']/100;  $total_fees=$total_fees+$detail; echo $detail?></td>
    <td><?php  if($fee_detail['submit']){echo $fee_detail['submit'];
      $total_fees_recived=$total_fees_recived+$fee_detail['submit'];
    } else {
      echo "0";
    }?></td>
    <td><?php
      if(!$fee_detail['submit']){
        $fee_detail['submit']="0";
      }/*
      echo $fee_detail['total_fees']."<br>";
      echo $fee_detail['fee_disc']."<br>";
      echo $fee_detail['submit']."<br>";*/
     echo $stu_remain=$fee_detail['total_fees']-($fee_detail['total_fees']*$fee_detail['fee_disc']/100)-$fee_detail['submit'];
     $total_remain_fee=$total_remain_fee+$stu_remain;?></td>
      <td><?php $row=fetchRow("Select id from fees_submit where ROLL=$fee_detail[roll]"); echo $row?></td>
    <td><img src=<?php echo ROOT.$propic;?> height="30" width="30" /></td><td><a href="index.php?mod=fee&do=edit_fee&student_roll=<?php echo $fee_detail['roll'];?>" title="Edit Profile"><img src=
      <?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a>
    </td>
    <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
</tr>

<?php }?>
<tr>
		<td colspan="20">
			<?php searchPaginationDisplay($total_row,$url.'&pageNumber=','',$pageData,$wh);?>
		</td>
</tr>
</table>


<p style="text-align:left">Total Fee Received : INR <?php echo $total_fees_recived;?> &nbsp; | &nbsp; Out of : INR  <?php echo $total_fees;?>&nbsp; | &nbsp; Remaining Fee : INR <?php echo $total_remain_fee;?></p>
