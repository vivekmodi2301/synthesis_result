<?php
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$table=$_GET['tname'];
		$col=fetchAll("select id from coloumn where patt_id=$id");
		//echo "select id from coloumn where patt_id=$id";
//exit;
		foreach ($col as  $col) {
			delete('coloumn',$col['id']);
		}
		dropTable($table);
		delete('patteren',$id);
		?>
		<script>
			location.href="index.php?mod=pattern&do=see_pattern";
		</script>
			<?php
	}
 ?>
	<div class="col-lg-12 table-resposive" style="margin-left:10px; font-family:'Century Gothic';">
    <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
    			<table class="table table-bordered table-hover">
            	<tr class="active1 table_style" style="font-weight:600;">
                    <td>Search by Pattern Name <input type="text" id="pname" onkeyup="search()" class="form-control" /></td>
                    <td>Select Class
                    	<select class="form-control" id="classs"  onchange="search()" name="class">
                        <option value="">Select Class</option>
												<?php
																			$class_data=fetchAll("select id,name from class");
																			foreach($class_data as $class_data){
																			?>
												                            	<option value="<?php echo $class_data['id'];?>"><?php echo $class_data['name'];?></option>
												                            <?php
																			}
																		?>

                    	</select>
                    </td>

                </tr>
            </table>
                <table class="table table-bordered table-hover" id="patt_table">
            	<tr class="active1 table_style" style="font-weight:600;">
                    <td width="100">Sr. No.</td>
                    <td width="300">Pattern Name</td>
                    <td width="200">Class Name</td>
                    <!--<td width="80">View Full Profile</td>-->
                    <td width="50" colspan="2">Action</td>
                </tr>
								<?php
									$sno=1;
									$stu_detail=fetchAll("select patteren.name as pattern,tname, class.name as class,patteren.id from patteren join class on class_id=class.id");
									//echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id";
									foreach ($stu_detail as  $stu_detail) {
								 ?>
                <tr class="primary1 table_style2">
                    <td><?php echo $sno++;?></td>
                    <td><?php echo $stu_detail['pattern'];?></td>
                    <td><?php echo $stu_detail['class'];?></td>
                    <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
                    <td><a href="index.php?mod=pattern&do=edit_pattern&id=<?php echo $stu_detail['id'];?>" title="Edit Profile"><img src=<?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a>
										| <a href="#" onclick="del('<?php echo $stu_detail['id'];?>','<?php echo $stu_detail['tname'];?>')" title="Delete Class"><img src=<?php echo ROOT."images/trash.png";?> height="20" width="20" /></a></td>
                </tr>
								<?php }?>
            </table>

    </form>
      </div>
			<script type="text/javascript">
				function search(){
					//alert(roll);
					classs=$('#classs').val();
					pname=$('#pname').val();
          //alert(classs);
					$.ajax({
						url:'module/pattern/search.php',
						data:'classs='+classs+'&name='+pname,
						type:'post',
						success:function(e){
							$('#patt_table').html(e);

						}
					});
					//alert(roll);
				}
			</script>

    <script>
    function  del(id,tname){
        if(confirm("Do you want to delete")){
          location.href="index.php?mod=pattern&do=see_pattern&id="+id+"&tname="+tname;
        }
      }
    </script>
