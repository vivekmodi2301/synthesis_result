<?php
	$total_fees_recived=0;
	$total_fees=0;
	$total_remain_fee=0;
 ?>

<?php
$date=date('d_M_Y',time());
$fileName = "fee_exe/".$date.'_'.time()."__studentlist.xls";
$_POST['filename']=$date.'_'.time()."__studentlist.xls";
	//$boys_fund=mysqli_query($con,"SELECT id, fund from boysfund");
$excel = new ExcelWriter($fileName);

	if($excel==false)
	{
		//echo "hi";exit;
		echo $excel->error;
		die;
	}
//echo "hii";exit;
	$myArr=array(
		"<b>S. No.</b>",
		"<b>Roll No.</b>",
		"<b>Student Name</b>",
		"<b>Father Name</b>",
		"<b>Class</b>",
		"<b>Batch</b>",
		"<b>Class total Fees</b>",
		"<b>Fee discount</b>",
		"<b>Student total Fees</b>",
		"<b>Fee Deposit</b>",
		"<b>Fee Due</b>",
		"<b>Installment 1st</b>",
		"<b>Installment 2nd</b>",
		"<b>Installment 3rd</b>",
		"<b>Installment 4th</b>",
		"<b>Installment 5th</b>",
		"<b>Installment 6th</b>",
		"<b>Installment 7th</b>",
);
			$excel->writeLine($myArr);


	$fee_detail=fetchAll("SELECT student_biodata.id,class.name as class,roll,s_name,f_name,batch.name as name,propic,total_fees,fee_disc,sum(fee_submit) as submit FROM student_biodata  join batch on batch=batch.id  join fees_submit on student_id=student_biodata.id join class on class=class.id GROUP by student_biodata.id order by student_biodata.id");
	$i=1;
	foreach($fee_detail as $fee_detail){
$myArr=array();
				$myArr[]=$i;
				$myArr[]=$fee_detail['roll'];
				$myArr[]=$fee_detail['s_name'];
				$myArr[]=$fee_detail['f_name'];
				$myArr[]=$fee_detail['class'];
				$myArr[]=$fee_detail['name'];
				$myArr[]=$fee_detail['total_fees'];
				$myArr[]=$fee_detail['fee_disc'];
				 $detail=$fee_detail['total_fees']-$fee_detail['total_fees']*$fee_detail['fee_disc']/100;  $total_fees=$total_fees+$detail; $myArr[]=$detail;
				if($fee_detail['submit']){$myArr[]=$fee_detail['submit'];
					$total_fees_recived=$total_fees_recived+$fee_detail['submit'];
				} else {
					$myArr[]="0";
				}
					if(!$fee_detail['submit']){
						$myArr[]=$fee_detail['submit']="0";
					}/*
					echo $fee_detail['total_fees']."<br>";
					echo $fee_detail['fee_disc']."<br>";
					echo $fee_detail['submit']."<br>";*/
				 $myArr[]= $stu_remain=$fee_detail['total_fees']-($fee_detail['total_fees']*$fee_detail['fee_disc']/100)-$fee_detail['submit'];
				 $fee_ins=fetchAll("select fee_submit,pay_number from fees_submit where student_id=$fee_detail[id]");
				 foreach($fee_ins as $fee_ins){
					 $ins=$fee_ins['fee_submit']."(".$fee_ins['pay_number'].")";
					 $myArr[]=$ins;
				 }
				 //exit;
$excel->writeLine($myArr);
$i++;
	}

		$excel->close();
		//exit;
addUpdate('feesexcel',$_POST,1);
$exe=glob("fee_exe/*.xls");
//print_r($exe);
$count=count($exe);
$count-=1;
//echo $count;exit;
for($i=0;$i<$count;$i++){
	if($i==$count){
		echo "hi";
		break;
	}
	else{
		//echo $exe[$i];exit;
		unlink($exe[$i]);
	}
}//exit;
?>
<script>
	location.href="index.php?mod=fee&do=list_excel";
</script>
