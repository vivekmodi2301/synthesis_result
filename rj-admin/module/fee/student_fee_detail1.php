<?php
  session_start();
  $total_fees="";
  $total_submited_fees="";
  $remaing_fee="";
  $phpfiles=glob("../../include/php/*.php");
  foreach($phpfiles as $phpfile){
    include_once($phpfile);
  }
  $student_roll=$_POST['student_roll'];
  $total_fees=fetchOne("select student_biodata.id,student_biodata.s_name as student,class.name as class,batch.name as batch,fee_disc,total_fees from student_biodata join class on class=class.id join batch on batch=batch.id  where student_biodata.roll='$student_roll' group by student_biodata.roll");
  if ($total_fees) {
  $total_submited_fees=fetchOne("select sum(fee_submit) as submited from fees_submit where roll=$total_fees[id] group by roll");
}
else {
  $_SESSION['eroll']="Enter correct roll number";
}
  if(!$total_submited_fees){
    $total_submited_fees=0;
  }
  //echo "select sum(fee_submit) as submited from fees_submit where student_id=$total_fees[id]";
  //print_r($total_submited_fees);
  //echo "select student_biodata.id,fee_disc,total_fees,sum(fee_submit) as submited from student_biodata join class on class=class.id join fees_submit on student_id=student_biodata.id  where student_biodata.roll='$student_roll' student_biodata.roll";
if($total_fees){
  $stu_total_fees=$total_fees['total_fees']-$total_fees['total_fees']*$total_fees['fee_disc']/100;
  //echo $stu_total_fees;

  $remaing_fee=$stu_total_fees-$total_submited_fees['submited'];
  //echo $remaing_fee;
}
if (isset($_SESSION['eroll'])) {
  echo $_SESSION['eroll'];
  unset($_SESSION['eroll']);
}
 ?>
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
    <input type="text" class="form-control" id="total_fee"  value="<?php if($total_fees) echo $total_fees['total_fees'];?>"  maxlength="7" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
      <input type="hidden" name="student_id" value="<?php echo $total_fees['id'];?>">
    </div>
</div>
<div class="form-group">
  <label class="col-lg-4 control-label">Fee Discount (%)</label>
    <div class="col-lg-8">
    <input type="text" class="form-control" id="fee_disc"  value="<?php if($total_fees) echo $total_fees['fee_disc'];?>" style="text-transform:capitalize;">
    </div>
</div>
<div class="form-group">
  <label class="col-lg-4 control-label">Fee After Discount (INR)</label>
    <div class="col-lg-8">
    <input type="text" class="form-control" id="fee_after_disc"  value="<?php if($total_fees) echo $stu_total_fees;?>" style="text-transform:capitalize;">
    </div>
</div>
<div class="form-group">
  <label class="col-lg-4 control-label">Due Amount</label>
    <div class="col-lg-8">
    <input type="text" class="form-control" id="fee_due"  value="<?php if($total_fees) echo $remaing_fee;?>" style="text-transform:capitalize;">
    </div>
</div>
<?php if($remaing_fee>0){?>
  <div class="form-group">
    <label class="col-lg-4 control-label">Paid by</label>
      <div class="col-lg-8">
      <input type="radio" onclick="sbox(this.value)"  class="radio-inline"  name="paid_by" value="cash">Cash
      <input type="radio" onclick="sbox(this.value)"  class="radio-inline"  name="paid_by" value="cheque">cheque
      <input type="radio" onclick="sbox(this.value)" class="radio-inline"  name="paid_by" value="dd">Deman Draft
      <span id="box"></span>
      </div>
  </div>
<div class="form-group">
  <label class="col-lg-4 control-label">Received Amount</label>
    <div class="col-lg-8">
    <input type="text"  class="form-control" id="received_fee_3" name="fee_submit" value="<?php
      if($total_fees && isset($total_fees[2])) echo $total_fees[2]['fee_submit'];
    ?>" style="text-transform:capitalize;" autofocus="autofocus">
    </div>
</div>
<div class="form-group">
  <label class="col-lg-4 control-label">Recived Date</label>
    <div class="col-lg-8">
    <input type="text" value="<?php echo date('d-m-Y');?>" class="form-control" id="received_fee_3" name="datee"  style="text-transform:capitalize;" autofocus="autofocus">
    </div>
</div>
<div class="form-group">
  <div class="col-lg-8 col-lg-offset-4">
    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
    </div>
</div>
<?php }?>
