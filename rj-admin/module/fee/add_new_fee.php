<?php
	if(isset($_POST['fee_submit'])){
		//echo "hi";exit;
		//print_r($_POST);
		addUpdate('fees_submit',$_POST);
		?>
		<script >
			location.href="index.php?mod=fee&do=see_all_fee"
		</script>
		<?php
	}
 ?>
	<div class="col-lg-12">
    <form role="form" method="post" class="form-horizontal" name="change_pwd" >
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Roll No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" onchange="fee_detail(this.value)" id="total_fee"  value="" pattern=".{5}" maxlength="5" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
                    </div>
                </div>
								<div id="fee_form">
                <div class="form-group">
                	<label class="col-lg-4 control-label">Total Fee (INR)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="total_fee"  value="" pattern=".{5}" maxlength="5" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Fee Discount (%)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="fee_disc"  value="" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Fee After Discount (INR)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="fee_after_disc"  value="" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Received Amount</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="received_fee_3"  value="" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Due Amount</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="fee_due"  value="" style="text-transform:capitalize;">
                    </div>
                </div>
							</div>
            </form>
</div>
<script type="text/javascript">
	function fee_detail(student_roll){
		$.ajax({
			url:"module/fee/student_fee_detail.php",
			data:"student_roll="+student_roll,
			type:'post',
			success:function(e){
				$('#fee_form').html(e);
			}
		})
	}
	function sbox(ptype) {
		if(ptype=='cash' || ptype=='dd'){
			$('#box').html('');
		}
		else {
			$('#box').html("<input type='text' name='pay_number' placeholder='Enter cheque or dd number' style='width:300px;'>");
		}
	}
</script>
