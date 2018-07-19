<?php
	if(isset($_GET['did'])){
		$did=$_GET['did'];
		delete('batch',$did);
		header("location:index.php?mod=class&do=see_batch");
	}
?>

	<div class="col-lg-12 table-responsive" style="margin-left:10px; font-family:'Century Gothic';">
    <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
                <table class="table table-bordered table-hover">
            	<tr class="active1 table_style" style="font-weight:600;">
                    <td width="100">Sr. No.</td>
                    <td width="100">Class ID</td>
                    <td width="300">Class Name</td>
                    <td width="100">Batch Id</td>
                    <td width="300">Batch Name</td>
                    <td width="300" colspan="2">Action</td>
                </tr>
                <?php
					$sno=1;
				 $batch_data=fetchAll("select batch.id as id,class.id as classid,batch.name as batch, class.name as class from batch join class on class_id=class.id");
				 if($batch_data){
				foreach($batch_data as $batch_data){
				?>

                <tr class="primary1 table_style2">
                    <td><?php echo $sno++;?></td>
                    <td><?php echo $batch_data['classid'];?></td>
                    <td><?php echo $batch_data['class'];?></td>
                    <td><?php echo $batch_data['id'];?></td>
                    <td><?php echo $batch_data['batch'];?></td>
                    <td><a href="index.php?mod=class&do=batch_edit&id=<?php echo $batch_data['id'];?>" title="Edit Batch"><img src="<?php echo ROOT."images/profile_edit.png";?>" height="20" width="20" /></a> | <a href="#" title="Delete Batch" onclick="del('<?php echo $batch_data['id'];?>')"><img src="<?php echo ROOT."images/trash.png";?>" height="20" width="20" /></a></td>
                </tr>
                <?php }}else{
				?>
                	<td colspan="6">No data till now</td>
                <?php
				}?>
            </table>

    </form>
      </div>

      <script>
	  	function del(did){
			if(confirm("Do you want to delete class")){
				location.href="index.php?mod=class&do=see_batch&did="+did;
			}
		}
	  </script>
