<?php
  if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $fdetail=fetchOne("select fees_submit.id,student_biodata.roll,fee_submit,paid_by,pay_number from fees_submit join student_biodata on student_id=student_biodata.id where fees_submit.id=$id");
  }
	if(isset($_POST['fee_submit'])){
		//echo "hi";exit;
		//print_r($_POST);
		addUpdate('fees_submit',$_POST,$id);
		header("location:index.php?mod=fee&do=edit_fee&student_roll=$_GET[rol]");
	}
 ?>
	<div class="col-lg-12">
    <form role="form" method="post" class="form-horizontal" name="change_pwd" >
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Roll No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" onchange="fee_detail(this.value)" id="total_fee"  value="<?php echo $fdetail['roll'];?>" pattern=".{5}" maxlength="5" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-lg-4 control-label">Paid by</label>
                      <div class="col-lg-8">
                      <input type="radio" <?php if ($fdetail['paid_by']=='cash') {
                        echo "checked";
                      }?> onclick="sbox(this.value)"  class="radio-inline"  name="paid_by" value="cash">Cash
                      <input type="radio" <?php if ($fdetail['paid_by']=='cheque') {
                        echo "checked";
                      }?> onclick="sbox(this.value)"  class="radio-inline"  name="paid_by" value="cheque">cheque
                      <input type="radio" <?php if ($fdetail['paid_by']=='dd') {
                        echo "checked";
                      }?> onclick="sbox(this.value)" class="radio-inline"  name="paid_by" value="dd">Deman Draft
                      <span id="box"><?php if($fdetail['paid_by']=='cheque'){
                        ?>
                          <input type='text' value="<?php echo $fdetail['pay_number'];?>" name='pay_number' placeholder='Enter cheque or dd number' style='width:300px;'>
                        <?php
                      }?></span>
                      </div>
                  </div>
                <div class="form-group">
                  <label class="col-lg-4 control-label">Received Amount</label>
                    <div class="col-lg-8">
                    <input type="text"  class="form-control" id="received_fee_3" name="fee_submit" value="<?php echo $fdetail['fee_submit'];?>" style="text-transform:capitalize;" autofocus="autofocus">
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-8 col-lg-offset-4">
                    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
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
