<?php
	if (isset($_GET['did'])) {
		$did=$_GET['did'];
		delete('student_biodata',$did);
		?>
		<script>
			location.href="index.php?mod=profile&do=see_all_profile";
		</script>
			<?php
	}
 ?>
	<div class="col-lg-12 table-responsive" style="margin-left:10px; font-family:'Century Gothic';">
                <table class="table table-bordered table-hover" id="stu_table">
            	<tr class="active1 table_style" style="font-weight:600;">
                    <td width="50">Sr. No.</td>
                    <td width="200">Student Name</td>
                    <td width="200">Father Name</td>
                    <td width="200">Class</td>
                    <td width="200">Batch</td>
                    <td width="120">Email</td>
                    <td width="120">Father Mobile Number</td>
                    <td width="300">Subject</td>
                    <td width="300">Query</td>
                    <td width="300">Date</td>
                    <!--<td width="80">View Full Profile</td>-->
                    <td width="50" colspan="2">Action</td>
                </tr>
								<?php
									$sno=1;
									$stu_detail=fetchAll("select contact.id,cdate,class.name as class,s_name,f_name,batch.name as name,email,s_mobile,f_mobile,contact_subject,contact_query from student_biodata join batch on batch=batch.id join class on class=class.id join contact on sid=student_biodata.id order by contact.id desc");
									//echo "select student_biodata.id,class.name as class,s_name,f_name,batch.name as name,email,s_mobile,contact_subject,contact_query from student_biodata join batch on batch=batch.id join class on class=class.id join contact on sid=student_biodata.id";
									foreach ($stu_detail as  $stu_detail) {
								 ?>
                <tr class="primary1 table_style2">
                    <td><?php echo $sno++;?></td>
                    <td width="200"><?php echo $stu_detail['s_name'];?></td>
                    <td width="200"><?php echo $stu_detail['f_name'];?></td>
                    <td width="200"><?php echo $stu_detail['class'];?></td>
                    <td width="200"><?php echo $stu_detail['name'];?></td>
                    <td width="120"><?php echo $stu_detail['email'];?></td>
                    <td width="120"><?php echo $stu_detail['f_mobile'];?></td>
                    <td width="100"><?php echo $stu_detail['contact_subject'];?></td>
                    <td width="100"><?php echo $stu_detail['contact_query'];?></td>
                    <td width="100"><?php echo $stu_detail['cdate'];?></td>
                    <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
                    <td><a href="index.php?mod=profile&do=detail_contact&id=<?php echo $stu_detail['id'];?>" title="Edit Profile"><img src=<?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a> </td>
                </tr>
								<?php }?>
            </table>

      </div>
			<script type="text/javascript">
				function showroll(){
					//alert(roll);
					roll=$('#roll').val();
					sname=$('#sname').val();
					fname=$('#fname').val();
					classs=$('#classs').val();
					batch=$('#batch').val();
					$.ajax({
						url:'module/profile/search.php',
						data:'roll='+roll+'&sname='+sname+'&fname='+fname+'&classs='+classs+'&batch='+batch,
						type:'post',
						success:function(e){
							$('#stu_table').html(e);

						}
					});
					//alert(roll);
				}
			</script>

			<script type="text/javascript">
				function showbatch(classid,batchid){

					//alert(classid);
					if(classid!=''){

							//alert(classid);
						$.ajax({
							url:"module/class/show_batch.php",
							data:"cid="+classid,
							type:'POST',
							success:function(e){
								$('#batch').removeAttr("disabled");
								$('#batch').html(e);
								showroll();
							}
						});
					}
					else{
						$('#batch').attr("disabled",true);
					}
				}
				function del(id) {
					if (confirm("Do you want to delete")) {
						location.href="index.php?mod=profile&do=see_all_profile&did="+id;
					}
				}
			</script>
