<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$batch_data=fetchOne("select id,class_id,name from batch where id=$id");	
	}
	else{
		header("location:index.php?mod=class&do=see_batch");	
	}
		if(isset($_POST['name'])){
			//print_r($_POST);exit;
		addUpdate('batch',$_POST,$id);
		header("location:index.php?mod=class&do=see_batch");
	}

?>
	<div class="col-lg-12">
    <form role="form" method="post" class="form-horizontal" name="change_pwd" enctype="multipart/form-data">
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Select Class</label>
                    <div class="col-lg-8">
                    <select class="form-control" id="" name="class_id">
                        <option>Please Select Class</option>
                        						<?php
							$class_data=fetchAll("select id,name from class");
							foreach($class_data as $class_data){
							?>
                            	<option <?php if($batch_data['class_id']==$class_data['id']){ echo "selected";}?> value="<?php echo $class_data['id'];?>"><?php echo $class_data['name'];?></option>
                            <?php	
							}
						?>

                    </select>
                    </div>
                </div>
                
                <div class="form-group">
                	<label class="col-lg-4 control-label">Modify Batch</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="" name="name" value="<?php echo $batch_data['name'];?>" style="text-transform:capitalize;">
                    </div>
                </div>
                
                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
</div>