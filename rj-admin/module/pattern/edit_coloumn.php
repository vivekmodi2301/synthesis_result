<?php
	if(isset($_GET['id']) && $_GET['id']){
		$id=$_GET['id'];
		$pattern_detail=fetchOne("select coloumn.id,class.name as name,sequence, patteren.name as patteren,tname, coloumn.name as coloumn from patteren join class on  class_id=class.id join coloumn on patt_id=patteren.id where coloumn.id=$id");
		//echo "select id,class_id,name from patteren where id=$id";
	if(isset($_POST['name'])){
		$qry="ALTER TABLE `$pattern_detail[tname]` CHANGE `$pattern_detail[coloumn]` `$_POST[name]` VARCHAR(20)";//exit;
		addUpdate('coloumn',$_POST,$id);
		changeColoumn($qry);
    ?>
      <script>
        location.href="index.php?mod=pattern&do=see_coloumn";
      </script>
  <?php }?>
	<div class="col-lg-12">
    <form role="form" method="post" class="form-horizontal" name="change_pwd" enctype="multipart/form-data" action="">
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Class</label>
                    <div class="col-lg-8">
											<input type="text" class="form-control" disabled value="<?php echo $pattern_detail['name'];?>">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Pattern Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" disabled  value="<?php echo $pattern_detail['patteren'];?>" id="" value="" style="text-transform:capitalize;">
                    </div>
                </div>

								                <div class="form-group">
								                	<label class="col-lg-4 control-label">Coloumn Name</label>
								                    <div class="col-lg-8">
								                    <input type="text" class="form-control" name="name"  value="<?php echo $pattern_detail['coloumn'];?>" id=""  style="text-transform:capitalize;">
								                    </div>
								                </div>
																<div class="form-group">
								                	<label class="col-lg-4 control-label">sequence</label>
								                    <div class="col-lg-8">
								                    <input type="text" class="form-control" name="sequence"  value="<?php echo $pattern_detail['sequence'];?>" id=""  style="text-transform:capitalize;">
								                    </div>
								                </div>
                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
</div>
<?php }else{
	?>
	<script>
		location.href="index.php?mod=pattern&do=see_pattern";
	</script>
	<?php
}?>
<script type="text/javascript">
	function showroll(){
		//alert(roll);
		classs=$('#class').val();
		batch=$('#pname').val();
		$.ajax({
			url:'module/profile/search.php',
			data:'class='+classs+'&pname='+pname,
			type:'post',
			success:function(e){
				$('#stu_table').html(e);

			}
		});
		//alert(roll);
	}
</script>
