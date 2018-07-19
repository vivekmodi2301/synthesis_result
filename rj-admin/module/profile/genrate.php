<?php 
  if(isset($_POST['class'])){
    echo "Class Id=".$_POST['class']."<br>Batch Id=".$_POST['batch'];
  }
 ?>
<div class="col-lg-12">
<form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
<div class="form-group">
  <label class="col-lg-4 control-label">Class</label>
    <div class="col-lg-8">
    <select class="form-control" onChange="showbatch(this.value)" id="class" name="class">
        <option value="<?php if(isset($_POST['class']) && $_POST['class']){echo $_POST['class'];}?>">Select Class</option>
        <?php
                      $class_data=fetchAll("select id,name from class");
                      foreach($class_data as $class_data){
                      ?>
                                      <option value="<?php echo $class_data['id'];?>"><?php echo $class_data['name'];?></option>
                                    <?php
                      }
                    ?>

    </select>


    </div>
</div>
<div class="form-group">
  <label class="col-lg-4 control-label">Batch</label>
    <div class="col-lg-8">
    <select class="form-control" disabled id="batch" name="batch">
      <option value="">Select Batch</option>
    </select>

    </div>
</div>
<div class="form-group">
      <div class="col-lg-8 col-lg-offset-4">
        <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
        </div>
    </div>
</div>

</form>
</div>
<script type="text/javascript">
	function showbatch(classid){
		if(classid!=''){
			$.ajax({
				url:"module/class/show_batch.php",
				data:"cid="+classid,
				type:'POST',
				success:function(e){
					$('#batch').removeAttr("disabled");
					$('#batch').html(e);
				}
			});
		}
		else{
			$('#batch').attr("disabled",true);
		}
	}
</script>
