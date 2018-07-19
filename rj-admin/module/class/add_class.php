<?php
	if(isset($_POST['name'])){
		//echo "hi";exit;
		$succ=1;
		if(!$_POST['name']){
			$_SESSION['ename']="Enter class name";
			$succ=0;
		}
		if(!$_POST['total_fees']){
			$_SESSION['etotal_fees']="Enter class total fees";
			$succ=0;
		}
		if($succ){
			addUpdate('class',$_POST);
		//echo "hi";exit;
		?>
        	<script>
				location.href="index.php?mod=class&do=see_class";
			</script>
        <?php
			}
	}
?>
	<div class="col-lg-12">
    <form role="form" method="post" class="form-horizontal" name="change_pwd" enctype="multipart/form-data">

                <div class="form-group">
                	<label class="col-lg-4 control-label">Name of New Class</label>
                    <div class="col-lg-8">
                    <input type="text" onchange="chkname(this.value)" class="form-control" id="name" name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" style="text-transform:capitalize;">
										<div id="cname"><?php if(isset($_SESSION['ename'])){echo $_SESSION['ename'];unset($_SESSION['ename']);}?></div>
                    </div>
                </div>

								<div class="form-group">
                	<label class="col-lg-4 control-label">Fees without tax</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="fee" value="<?php if(isset($_POST['total_fees'])){echo $_POST['total_fees'];}?>" name="fee" >
                    </div>
										<?php if(isset($_SESSION['etotal_fees'])){echo $_SESSION['etotal_fees'];unset($_SESSION['etotal_fees']);}?>
                </div>

								<div class="form-group">
									<label class="col-lg-4 control-label">Tax in %</label>
										<div class="col-lg-8">
										<input type="text" id="tax" class="form-control" onchange="totfee(fee.value,this.value)" name="tax" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>">
								</div>
							</div>


								<div class="form-group">
								 	<label class="col-lg-4 control-label">Total Fees</label>
								    <div class="col-lg-8">
								       <input type="text" class="form-control" id="tfee" value="<?php if(isset($_POST['total_fees'])){echo $_POST['total_fees'];}?>" name="total_fees" >
								    </div>
										<?php if(isset($_SESSION['etotal_fees'])){echo $_SESSION['etotal_fees'];unset($_SESSION['etotal_fees']);}?>
								</div>

                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
</div>
<script type="text/javascript">
function chkname(name) {
	$.ajax({
		url:"module/class/chk_class.php",
		data:"name="+name,
		type:"post",
		success:function (e) {
			$('#cname').html(e);
		}
	});
}

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
