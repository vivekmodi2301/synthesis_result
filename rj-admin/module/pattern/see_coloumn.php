<?php
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$tname=$_GET['tname'];
		$col=fetchOne("select name from coloumn where id=$id");
		dropcoloumn("alter table `$tname` drop `$col[name]`");
		//echo "alter table `$tname` drop `$col[name]`";exit;
		delete('coloumn',$id);
		//exit;
		?>
		<script>
			location.href="index.php?mod=pattern&do=see_coloumn";
		</script>
			<?php
	}
 ?>
	<div class="col-lg-12 table-resposive" style="margin-left:10px; font-family:'Century Gothic';">
    <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
    			<table class="table table-bordered table-hover">
            	<tr class="active1 table_style" style="font-weight:600;">
                    <td>Search by Pattern Name <input type="text" id="pname" onkeyup="search()" class="form-control" /></td>
										<td>Search by Subject Name <input type="text" id="cname" onkeyup="search()" class="form-control" /></td>
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
                    <td width="200">Pattern Name</td>
                    <td width="200">Class Name</td>
                    <td width="200">Subject Name</td>
										<td width="200">Sequence Number</td>
                    <!--<td width="80">View Full Profile</td>-->
                    <td width="50" colspan="2">Action</td>
                </tr>
								<?php
									$sno=1;
									$patt_detail=fetchAll("select coloumn.id,sequence,class.name as class, patteren.name as patteren,patteren.tname, coloumn.name as coloumn from patteren join class on  class_id=class.id join coloumn on patt_id=patteren.id  order by coloumn.id ");
									//echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id";
									foreach ($patt_detail as  $patt_detail) {
								 ?>
                <tr class="primary1 table_style2">
                    <td><?php echo $sno++;?></td>
                    <td><?php echo $patt_detail['patteren'];?></td>
                    <td><?php echo $patt_detail['class'];?></td>
                    <td style="text-transform:uppercase;"><?php echo $patt_detail['coloumn'];?></td>
                    <td><?php echo $patt_detail['sequence'];?></td>
                    <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
                    <td><a href="index.php?mod=pattern&do=edit_coloumn&id=<?php echo $patt_detail['id'];?>" title="Edit Profile"><img src=<?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a> | <a href="#" onclick="del('<?php echo $patt_detail['id'];?>','<?php echo $patt_detail['tname'];?>')">Delete</a></td>
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
					cname=$('#cname').val();
          //alert(classs);
					$.ajax({
						url:'module/pattern/search_coloumn.php',
						data:'classs='+classs+'&name='+pname+'&cname='+cname,
						type:'post',
						success:function(e){
							$('#patt_table').html(e);

						}
					});
					//alert(roll);
				}
			</script>

    <script>
      function del(id,tname){
        //alert(tname);
        if(confirm("Do you want to delete")){
          location.href="index.php?mod=pattern&do=see_coloumn&id="+id+"&tname="+tname;
        }
      }
    </script>
