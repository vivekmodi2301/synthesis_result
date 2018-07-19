<?php
if (isset($_GET['did'])) {
	delete('fees_submit',$_GET['did']);
}
$total_fees="";
$total_submited_fees="";
$remaing_fee="";
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
	include_once($phpfile);
}
if (isset($_POST['fee_submit'])) {
	print_r($_POST);exit;
}
$student_roll=$_GET['student_roll'];
$total_fees=fetchOne("select student_biodata.id,student_biodata.s_name as student,class.name as class,batch.name as batch,fee_disc,total_fees from student_biodata join class on class=class.id join batch on batch=batch.id  where student_biodata.roll='$student_roll' group by student_biodata.roll");
//echo "select student_biodata.id,student_biodata.s_name as student,class.name as class,batch.name as batch,fee_disc,total_fees from student_biodata join class on class=class.id join batch on batch=batch.id  where student_biodata.roll='$student_roll' group by student_biodata.roll";
if($total_fees){
	$stu_fees_ins=fetchAll("select id,roll,fee_submit,datee,paid_by,pay_number from fees_submit where roll=". $student_roll);
	//echo "select id,roll,fee_submit,datee,paid_by,pay_number from fees_submit where roll=". $student_roll;
	$total_ins=count($stu_fees_ins);
	//print_r($stu_fees_ins);
}
if ($total_fees) {
$total_submited_fees=fetchOne("select sum(fee_submit) as submited from fees_submit where roll=$student_roll group by roll");
//echo "select sum(fee_submit) as submited from fees_submit where roll=$student_roll group by roll";

}
else {
$_SESSION['eroll']="Enter correct roll number";
}
if(!$total_submited_fees){
	$total_submited_fees=0;
}
if($total_fees){
@  $stu_total_fees=$total_fees['total_fees']-$total_fees['total_fees']*$total_fees['fee_disc']/100;
  //echo $stu_total_fees;

  $remaing_fee=$stu_total_fees-$total_submited_fees['submited'];
  //echo $remaing_fee;
}
 ?>
	<div class="col-lg-12">
    <form role="form" class="form-horizontal" name="change_pwd" enctype="multipart/form-data" action="">
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Roll No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="total_fee" name="" value="<?php echo $student_roll;?>" pattern=".{5}" maxlength="5" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Student Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" name="" value="<?php echo $total_fees['student'];?>"  style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Class</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" name="" value="<?php echo $total_fees['class'];?>"  style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Batch</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" name="" value="<?php echo $total_fees['batch'];?>" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Total Fee (INR)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="total_fee" name="total_fee" value="<?php echo $total_fees['total_fees'];?>" pattern=".{5}" maxlength="5" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Fee Discount (%)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="fee_disc" name="fee_disc" value="<?php if($total_fees['fee_disc']) echo $total_fees['fee_disc']; else echo  0;?>" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Fee After Discount (INR)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="fee_after_disc" name="fee_after_disc" value="<?php echo $stu_total_fees;?>" style="text-transform:capitalize;">
                    </div>
                </div>
								<?php for($ins=0;$ins<$total_ins;$ins++){ ?>
 								<div class="form-group">
								  <label class="col-lg-4 control-label">Received Amount (<?php echo $ins+1;?>)</label>
								    <div class="col-lg-8">
								    <input type="text" class="form-control" id="received_fee_1" name="received_fee_1" value="<?php
								      if($total_fees){ echo $stu_fees_ins[$ins]['fee_submit'];}
								    ?>" style="text-transform:capitalize;">
										<?php if($stu_fees_ins[$ins]['paid_by']=='cheque'){
										 echo "Cheque No : ".$stu_fees_ins[$ins]['pay_number']."&nbsp;&nbsp;|&nbsp;&nbsp;";}
										 echo "Date : ".$stu_fees_ins[$ins]['datee'];
									 ?>
								    </div>

								</div>
								<?php } ?>
<!--								<div class="form-group">
								  <label class="col-lg-4 control-label">Received Amount (2<sup>nd</sup> Installment)</label>
								    <div class="col-lg-8">
								    <input type="text" class="form-control" id="received_fee_2" name="received_fee_2" value="<?php
								      /*if($total_fees && isset($stu_fees_ins[1])){
												echo $stu_fees_ins[1]['fee_submit'];
												if($stu_fees_ins[1]['paid_by']=='cheque'){
													echo "(".$stu_fees_ins[1]['pay_number'].")";
												}}
								    else echo "0";*/?>" style="text-transform:capitalize;">
								    </div>
								</div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Received Amount (3<sup>rd</sup> Installment)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="received_fee_3" name="received_fee_3" value="<?php
								      /*if($total_fees && isset($stu_fees_ins[2])){
												 echo $stu_fees_ins[2]['fee_submit'];
												 if($stu_fees_ins[2]['paid_by']=='cheque'){
	 												echo "(".$stu_fees_ins[2]['pay_number'].")";
	 											}}
								    else echo "0";*/?>" style="text-transform:capitalize;">
                    </div>
                </div>-->
                <div class="form-group">
                	<label class="col-lg-4 control-label">Due Amount</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="fee_due" name="fee_due" value="<?php echo $remaing_fee;?>" style="text-transform:capitalize;">
                    </div>
                </div>
            </form>
</div>
<script type="text/javascript">
	function fedit(fid,span) {
		$.ajax({
			url:"module/fee/edit_one_fee.php",
			data:"fid="+fid,
			type:"post",
			success:function (e) {
				$('#'+span).html(e);
			}
		});
	}
	function del(id) {
		if(confirm("Do you want to delete")){
			location.href="index.php?mod=fee&do=edit_fee&did="+id;
		}
	}
</script>
