<?php
	if(isset($_GET['id'])){
		$class_id=$_GET['id'];
		$one_class_detail=fetchOne("select id,name,total_fees,fee,tax from class where id=$class_id");
	}
	else{
		header("location:index.php?mod=class&do=see_class");
	}
	if(isset($_POST['name'])){
		//echo "hi";exit;
		addUpdate('class',$_POST,$class_id);
		header("location:index.php?mod=class&do=see_class");
	}
?>
	<div class="col-lg-12">
    <form role="form" class="form-horizontal" method="post" name="change_pwd" enctype="multipart/form-data" >

                <div class="form-group">
                	<label class="col-lg-4 control-label">Modify Class</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="" name="name" value="<?php if($one_class_detail['name']){echo $one_class_detail['name'];}?>" style="text-transform:capitalize;">
                    </div>
                </div>


																<div class="form-group">
								                	<label class="col-lg-4 control-label">Fees without tax</label>
								                    <div class="col-lg-8">
								                    <input type="text" class="form-control" id="fee" value="<?php if(isset($one_class_detail['tax'])){echo $one_class_detail['fee'];}?>" name="fee" >
								                    </div>
																		<?php if(isset($_SESSION['etotal_fees'])){echo $_SESSION['etotal_fees'];unset($_SESSION['etotal_fees']);}?>
								                </div>

																<div class="form-group">
																	<label class="col-lg-4 control-label">Tax in %</label>
																		<div class="col-lg-8">
																		<input type="text" id="tax" class="form-control" onchange="totfee(fee.value,this.value)" name="tax" value="<?php if(isset($one_class_detail['tax'])){echo $one_class_detail['tax'];}?>">
																</div>
															</div>


																<div class="form-group">
								                	<label class="col-lg-4 control-label">Total Fees</label>
								                    <div class="col-lg-8">
								                    <input type="text" class="form-control" id="tfee" name="total_fees" value="<?php if($one_class_detail['total_fees']){echo $one_class_detail['total_fees'];}?>" style="text-transform:capitalize;"  onBlur="if (this.value == '') {this.value = 'Username';}"  maxlength="7" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
								                    </div>
								                </div>

                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
</div>
<script>

function totfee(fee,tax) {
	var fee = parseInt(fee);
var tax = parseInt(tax);
	tfee=fee*tax/100;
	tfee=fee+tfee;
	$.ajax({
		success:function (e) {
			$('#tfee').val(tfee);
		}
	});
}
</script>
