<?php
	if(isset($_POST['name'])){
		$succ=1;
		if(!$_POST['name']){
			$_SESSION['ename']="Enter your name";
			$succ=0;
		}
		if(!$_POST['class_id']){
			$_SESSION['eclass']="Select your class";
			$succ=0;
		}
		if($succ){
		addUpdate('batch',$_POST);
		header("location:index.php?mod=class&do=see_batch");
	}
	}
?>
	<div class="col-lg-12">
    <form role="form" method="post" class="form-horizontal" name="change_pwd" enctype="multipart/form-data" action="">
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Select Class</label>
                    <div class="col-lg-8">
                    <select class="form-control"  id="classs" name="class_id">
                    <option value="">Please Select Class</option>
						<?php
							$class_data=fetchAll("select id,name from class");
							foreach($class_data as $class_data){
							?>
                            	<option value="<?php echo $class_data['id'];?>"><?php echo $class_data['name'];?></option>
                            <?php
							}
						?>
                    </select>
										<div id="eclass">
											<?php
											if (isset($_SESSION['eclass'])) {
												echo $_SESSION['eclass'];unset($_SESSION['eclass']);
											} ?>
										</div>
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Name of New Batch</label>
                    <div class="col-lg-8">
                    <input type="text"  class="form-control" onchange="chkbatch(this.value,classs.value)" id="cname"  name="name" value="" style="text-transform:capitalize;">
										<div id="name">

												<?php
												if (isset($_SESSION['ename'])) {
													echo $_SESSION['ename'];unset($_SESSION['ename']);
												} ?>
										</div>
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
function chkbatch(name,class_id) {
	$.ajax({
		url:"module/class/chk_batch.php",
		data:"name="+name+"&class="+class_id,
		type:"post",
		success:function (e) {
			$('#name').html(e);
		}
	});
}
</script>
