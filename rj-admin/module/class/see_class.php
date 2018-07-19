<?php
	if(isset($_GET['did'])){
		$did=$_GET['did'];
		//echo"select id from patteren where patt_id=$patt[id]";exit;
		$batch=fetchAll("select id from batch where class_id=$did");
		foreach ($batch as $batch) {
			delete('batch',$batch['id']);
		}

		$patt=fetchAll("select id,tname from patteren where class_id=$did");
		foreach ($patt as $patt) {
			//echo"select id from patteren where patt_id=$patt[id]";exit;
			dropTable($patt['tname']);
			$coloumn=fetchAll("select id from coloumn where patt_id=$patt[id]");
			foreach ($coloumn as $coloumn) {
				delete('coloumn',$coloumn['id']);
			}
			delete('patteren',$patt['id']);
		}
		delete('class',$did);
		header("location:index.php?mod=class&do=see_class");
	}
?>
	<div class="col-lg-12 table-responsive" style="margin-left:10px; font-family:'Century Gothic';">
    <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
                <table class="table table-bordered table-hover">
            	<tr class="active1 table_style" style="font-weight:600;">
                    <td width="100">Sr. No.</td>
                    <td width="300">Class Name</td>
                    <td width="300">Total Fees</td>
                    <td width="200" colspan="2">Action</td>
                </tr>
                <?php
					$sno=1;
				 $class_data=fetchAll("select id,name,total_fees from class");
				 if($class_data){
				foreach($class_data as $class_data){
				?>
                <tr class="primary1 table_style2">
                    <td><?php echo $sno++;?></td>
                    <td><?php echo $class_data['name'];?></td>
                    <td><?php echo $class_data['total_fees'];?></td>
                    <td><a href="index.php?mod=class&do=class_edit&id=<?php echo $class_data['id'];?>" title="Edit Class"><img src="<?php echo ROOT."images/profile_edit.png";?>" height="20" width="20" /></a> | <a href="#" onclick="del('<?php echo $class_data['id'];?>')" title="Delete Class"><img src=<?php echo ROOT."images/trash.png";?> height="20" width="20" /></a></td>
                </tr>
                <?php } }else{?>
					<tr class="primary1 table_style2">
                    <td colspan="4">No data till now</td>
                    </tr>
				<?php }?>
            </table>

    </form>
      </div>
      <script>
	  	function del(did){
			if(confirm("Do you want to delete class")){
				location.href="index.php?mod=class&do=see_class&did="+did;
			}
		}
	  </script>
