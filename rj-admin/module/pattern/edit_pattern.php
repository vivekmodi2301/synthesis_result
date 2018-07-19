<?php
	if(isset($_GET['id']) && $_GET['id']){
		$id=$_GET['id'];
		$pattern_detail=fetchOne("select id,class_id,name from patteren where id=$id");
		//echo "select id,class_id,name from patteren where id=$id";
	if(isset($_POST['class_id'])){
		addUpdate('patteren',$_POST,$id);

    ?>
      <script>
        location.href="index.php?mod=pattern&do=see_pattern";
      </script>
  <?php }?>
	<div class="col-lg-12">
    <form role="form" method="post" class="form-horizontal" name="change_pwd" enctype="multipart/form-data" action="">
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Select Class</label>
                    <div class="col-lg-8">
                    <select class="form-control"  name="class_id">
                    <option value="">Please Select Class</option>
						<?php
							$class_data=fetchAll("select id,name from class");
							foreach($class_data as $class_data){
							?>
                            	<option <?php if($pattern_detail['class_id']==$class_data['id']){echo "selected";}?> value="<?php echo $class_data['id'];?>"><?php echo $class_data['name'];?></option>
                            <?php
							}
						?>
                    </select>
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Name of New Pattern</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control"  value="<?php echo $pattern_detail['name'];?>" id="" name="name" value="" style="text-transform:capitalize;">
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
