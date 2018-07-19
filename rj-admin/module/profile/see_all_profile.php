<style>

/*===============================Footer CSS Put it at bottum always================== */
#pg{CLEAR: both;MARGIN: 2em 0px 2em 12px;COLOR: #3666d4;HEIGHT: 2em}
#pg A{BORDER-RIGHT: #ccdbe4 1px solid;PADDING-RIGHT: 8px;BORDER-TOP: #ccdbe4 1px solid;DISPLAY: block;PADDING-LEFT: 8px;FLOAT: left;PADDING-BOTTOM: 2px;MARGIN: 0px 5px 0px 0px;BORDER-LEFT: #ccdbe4 1px solid;COLOR: #3666d4;PADDING-TOP: 2px;BORDER-BOTTOM: #ccdbe4 1px solid;TEXT-ALIGN: center;TEXT-DECORATION: none}
#pg STRONG{BORDER-RIGHT: #ccdbe4 1px solid;PADDING-RIGHT: 8px;BORDER-TOP: #ccdbe4 1px solid;DISPLAY: block;PADDING-LEFT: 8px;FLOAT: left;PADDING-BOTTOM: 2px;MARGIN: 0px 5px 0px 0px;BORDER-LEFT: #ccdbe4 1px solid;COLOR: #3666d4;PADDING-TOP: 2px;BORDER-BOTTOM: #ccdbe4 1px solid;TEXT-ALIGN: center;TEXT-DECORATION: none}
#pg A:hover{BORDER-LEFT-COLOR: #2b55af;BACKGROUND: #3666d4;BORDER-BOTTOM-COLOR: #2b55af;COLOR: #fff;BORDER-TOP-COLOR: #2b55af;BORDER-RIGHT-COLOR: #2b55af}
#pg STRONG{BORDER-RIGHT: 0px;PADDING-RIGHT: 6px;BORDER-TOP: 0px;PADDING-LEFT: 6px;FONT-WEIGHT: bold;FONT-SIZE: 108%;PADDING-BOTTOM: 2px;BORDER-LEFT: 0px;COLOR: #000;PADDING-TOP: 2px;BORDER-BOTTOM: 0px}
#pg-next{BORDER-TOP-WIDTH: 2px;MARGIN-TOP: -2px;BORDER-LEFT-WIDTH: 2px;BORDER-BOTTOM-WIDTH: 2px;PADDING-BOTTOM: 1px;PADDING-TOP: 1px;BORDER-RIGHT-WIDTH: 2px}
#pg-prev{BORDER-TOP-WIDTH: 2px;MARGIN-TOP: -2px;BORDER-LEFT-WIDTH: 2px;BORDER-BOTTOM-WIDTH: 2px;PADDING-BOTTOM: 1px;PADDING-TOP: 1px;BORDER-RIGHT-WIDTH: 2px; background-color:#CC0066}
#pg-next{MARGIN-LEFT: 9px}
#pg-prev{MARGIN-RIGHT: 14px}
#pg-selected { background-color:#CC99FF }
</style>

<?php
if(isset($_SESSION['wh'])){
	unset($_SESSION['wh']);
}
	if (isset($_GET['did'])) {
		$did=$_GET['did'];
		delete('student_biodata',$did);
		?>
		<script>
			location.href="index.php?mod=profile&do=see_all_profile";
		</script>
			<?php
	}
	$url="index.php?mod=profile&do=see_all_profile";
	$limit=1;
$frmdataget=$_REQUEST;
@PaginationWork(10);
	$totRslt=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as tot from student_biodata left join batch on batch=batch.id left join class on class=class.id"));
	$qry="select student_biodata.id,roll,class.name as class,s_name,f_name,batch.name as name,propic from student_biodata left join batch on batch=batch.id left join class on class=class.id limit ".$frmdata['from'].", ".$frmdata['to'];
	$maxPageData=100;
	if($totRslt['tot']<100){
		$maxPageData=$totRslt['tot'];
	}
	$rs=mysqli_query($con,$qry);
 ?>
 <?php
 	if(isset($_SESSION['udata'])){
 		echo $_SESSION['udata'];unset($_SESSION['udata']);
 	}
 ?>
	<div class="col-lg-12 table-responsive" style="margin-left:10px; font-family:'Century Gothic';">
    <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
    			<table class="table table-bordered table-hover">
            	<tr class="active1 table_style" style="font-weight:600;">
                    <td width="100">Search by Roll No. <input type="text" id="roll" onkeyup="showroll()" class="form-control" /></td>
                    <td>Search by Student Name <input type="text" id="sname" onkeyup="showroll()" class="form-control" /></td>
                    <td>Search by Father Name <input type="text" id="fname" onkeyup="showroll()" class="form-control" /></td>
										<td>Search by City or State <input type="text" id="citystate" onkeyup="showroll()" class="form-control" /></td>
                    <td>Select Class
                    	<select class="form-control" id="classs"  onchange="showbatch(this.value)" name="class">
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
                    <td>Select Batch
                    	<select class="form-control" id="batch" onchange="showroll()" name="batch">
                        <option value="">Select Batch</option>
                    	</select>
                    </td>

										<td>No of data
                    	<select class="form-control" id="nod"  onchange="showroll()" name="class">
                        <option value="">Select Class</option>
												<?php
													for($i=10;$i<=$maxPageData;$i+=10){
																			?>
												             <option value="<?php echo $i;?>"><?php echo $i?> </option>
												             <?php
																			}
																		?>

                    	</select>
                    </td>
                </tr>
            </table>

						<?php
							$sno=1;

$tot_student=fetchRow("select student_biodata.id,roll,class.name as class,s_name,f_name,batch.name as name,propic from student_biodata left join batch on batch=batch.id left join class on class=class.id");
?>
                <table class="table table-bordered table-hover" id="stu_table">
									<tr><td colspan="8"><span style="color:#900; font-weight:bold;">Total Students in this section : <?php echo $tot_student;?></span></td></tr>
            	<tr class="active1 table_style" style="font-weight:600;">
                    <td width="50">Sr. No.</td>
                    <td width="80">Roll No.</td>
                    <td width="200">Student Name</td>
                    <td width="200">Father Name</td>
                    <td width="120">Class</td>
                    <td width="120">Batch</td>
                    <td width="100">Photo</td>
                    <!--<td width="80">View Full Profile</td>-->
                    <td width="50" colspan="2">Action</td>
                </tr>
									<?php
									//echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id";
									while($stu_detail=mysqli_fetch_assoc($rs)) {

											if($stu_detail['propic']){
												$propic="images/student_images/".$stu_detail['propic'];
											}else{
												$propic="images/view.gif";
											}
								 ?>
                <tr class="primary1 table_style2">
                    <td><?php echo $sno++;?></td>
                    <td><?php echo $stu_detail['roll'];?></td>
                    <td><?php echo $stu_detail['s_name'];?></td>
                    <td><?php echo $stu_detail['f_name'];?></td>
                    <td><?php echo $stu_detail['class'];?></td>
                    <td><?php echo $stu_detail['name'];?></td>
                    <td><img src=<?php echo ROOT.$propic;?> height="30" width="30" /></td>
                    <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
                    <td><a href="index.php?mod=profile&do=edit_profile&id=<?php echo $stu_detail['id'];?>" title="Edit Profile"><img src=<?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a> | <a href="#" title="Delete Profile" onclick="del(<?php echo $stu_detail['id'];?>)"><img src=
											<?php echo ROOT."images/trash.png";?> height="20" width="20" /></a></td>
                </tr>
								<?php }?>
								<tr>
										<td colspan="20">
											<?php PaginationDisplay($totRslt['tot'],$url.'&pageNumber=','','10','View More Photos');?>
										</td>
								</tr>
            </table>

    </form>
      </div>
			<script type="text/javascript">
				function showroll(){
					//alert(roll);
					roll=$('#roll').val();
					sname=$('#sname').val();
					fname=$('#fname').val();
					classs=$('#classs').val();
					batch=$('#batch').val();
					citystate=$('#citystate').val();
					nod=$('#nod').val();
					//alert(nod);
					$.ajax({
						url:'module/profile/search.php',
						data:'roll='+roll+'&sname='+sname+'&fname='+fname+'&classs='+classs+'&batch='+batch+'&citystate='+citystate+"&wh='yes'&nod="+nod,
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
						$('#batch').html("<option value=''>Select batch</option>");
						showroll();
					}
				}
				function showpage(where,page){
					// alert(where);
					$.ajax({
						url:'module/profile/search.php',
						data:"where="+where+"&pageNumber="+page,
						type:'post',
						success:function(e){
							$('#stu_table').html(e);

						}
					});
				}
				function del(id) {
					if (confirm("Do you want to delete")) {
						location.href="index.php?mod=profile&do=see_all_profile&did="+id;
					}
				}
			</script>
