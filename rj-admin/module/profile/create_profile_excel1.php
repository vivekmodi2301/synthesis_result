<?php
$date=date('d_M_Y',time());
$fileName = "profile_exe/".$date.'_'.time()."__studentlist.xls";
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
		"<b>Roll No</b>",
		"<b>Student Id</b>",
		"<b>Student Name</b>",
	"<b>Father Name</b>",
"<b>Mother Name</b>",
"<b>Fee Discount</b>",
"<b>Date of Addmission</b>",
"<b>Class</b>",
"<b>Batch</b>",
"<b>Email</b>",
"<b>Father Mobile No.</b>",
"<b>Mother Mobile No.</b>",
"<b>Student Mobile No.</b>",
"<b>Gender</b>",
"<b>Category</b>",
"<b>Date of Birth</b>",
"<b>Landline No.</b>",
"<b>Address</b>",
"<b>State</b>",
"<b>District</b>",
"<b>Pin No.</b>",
"<b>Class X Roll No.</b>",
"<b>Class X Per./ CGPA</b>",
"<b>Class X School Name</b>",
"<b>Class X Board</b>",
"<b>Class XII Roll No.</b>",
"<b>Class XII Per./ CGPA</b>",
"<b>Class XII School Name</b>",
"<b>Class XII Board</b>",
"<b>AIPMT Roll No(If Eligible)</b>",
"<b>AIIMS Roll No(If Eligible)</b>",
"<b>AIPVT Roll No(If Eligible)</b>",
"<b>IIT Roll No(If Eligible)</b>",
"<b>Remark</b>"
);
			$excel->writeLine($myArr);

	$myArr=array();
	$data=fetchAll("select  `m_name`, class.name as class, batch.name as batch, `email`, `f_mobile`, `m_mobile`, `s_mobile`, `gender`, `cat`, `dob`, `ll_no`, `adrs`, `state`, `district`, `pin`, `propic`, `10th_roll`, `10th_%`, `10th_school_name`, `10th_board`, `12th_roll`, `12th_%`, `12th_school_name`, `12th_board`, `aipmt_roll`, `aiims_roll`, `aipvt_roll`, `iit_roll`, `remark`, `fee_disc`, `doa`,`roll`, `s_name`, `f_name`,student_biodata.id from student_biodata join class on class=class.id join batch on batch=batch.id");

	$i=1;
	foreach($data as $data){
		extract($data);
		$myArr[]="$i";
		$myArr[]="$roll";
		$myArr[]="$id";
		$myArr[]="$s_name";
		$myArr[]="$f_name";
		$myArr[]="$m_name";
		$myArr[]=$fee_disc;
		$myArr[]=$doa;
		$myArr[]="$class";
		$myArr[]="$batch";
		$myArr[]="$email";
		$myArr[]="$f_mobile";
		$myArr[]="$m_mobile";
		$myArr[]="$s_mobile";
		$myArr[]="$gender";
		$myArr[]="$cat";
		$myArr[]="$dob";
		$myArr[]="$ll_no";
		$myArr[]="$adrs";
		$myArr[]="$state";
		$myArr[]="$district";
		$myArr[]="$pin";
		$myArr[]=$data['10th_roll'];
		$myArr[]=$data['10th_%'];
		$myArr[]=$data['10th_school_name'];
		$myArr[]=$data['10th_board'];
		$myArr[]=$data['12th_roll'];
		$myArr[]=$data['12th_%'];
		$myArr[]=$data['12th_school_name'];
		$myArr[]=$data['12th_board'];
		$myArr[]=$data['aipmt_roll'];
		$myArr[]=$data['aiims_roll'];
		$myArr[]=$data['aipvt_roll'];
		$myArr[]=$data['iit_roll'];
		$myArr[]=$data['remark'];
$excel->writeLine($myArr);
$i++;
	}

		$excel->close();
addUpdate('profileexcel',$_POST,1);
$exe=glob("profile_exe/*.xls");
//print_r($exe);
$count=count($exe);
$count-=1;
//echo $count;exit;
for($i=0;$i<=$count;$i++){
	if($i==$count){
		break;
	}
	else{
		unlink($exe[$i]);
	}
}
?>
<script>
	location.href="index.php?mod=profile&do=exe_list";
</script>
