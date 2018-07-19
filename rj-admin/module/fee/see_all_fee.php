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
	if(isset($_SESSION['udata'])){
		echo $_SESSION['udata'];
		unset($_SESSION['udata']);
	}
?>
<?php
	$total_fees_recived=0;
	$total_fees=0;
	$total_remain_fee=0;
	$url="index.php?mod=fee&do=see_all_fee";
	$limit=1;
	$frmdataget=$_REQUEST;
	@PaginationWork();
	$totRslt=mysqli_query($con,"select count(*) as tot from student_biodata  join batch on batch=batch.id  join fees_submit on fees_submit.ROLL=student_biodata.roll join class on class=class.id GROUP by student_biodata.id order by student_biodata.id");
	//echo "select count(*) as tot from student_biodata  join batch on batch=batch.id  join fees_submit on fees_submit.ROLL=student_biodata.roll join class on class=class.id GROUP by student_biodata.id order by student_biodata.id";

$rs=mysqli_query($con,"SELECT student_biodata.id,class.name as class,student_biodata.roll,s_name,f_name,batch.name as name,propic,total_fees,fee_disc,sum(fee_submit) as submit FROM student_biodata  join batch on batch=batch.id  join fees_submit on fees_submit.ROLL=student_biodata.roll	 join class on class=class.id GROUP by student_biodata.id order by student_biodata.id limit ".$frmdata['from'].", ".$frmdata['to']);

					$total_row=mysqli_num_rows($totRslt);
					$maxPageData=100;
					if($total_row<100){
						$maxPageData=$total_row;
					}
 ?>
 
	<div class="col-lg-12 table-responsive" style="margin-left:10px; font-family:'Century Gothic';">
    <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
    			<table class="table table-bordered table-hover">

            	<tr class="active1 table_style" style="font-weight:600;">
								<td width="100">Search by Roll No. <input type="text" id="roll" onkeyup="showroll()" class="form-control" /></td>
								<td>Search by Student Name <input type="text" id="sname" onkeyup="showroll()" class="form-control" /></td>
								<td>Search by Father Name <input type="text" id="fname" onkeyup="showroll()" class="form-control" /></td>
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
									<select class="form-control"  id="batch" onchange="showroll()" name="batch">
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
					</form>
					<div id="table">
                <table class="table table-bordered table-hover">
									<tr>
										<td colspan="15"><span style="color:#900; font-weight:bold;">Total Students in this section : <?php echo $total_row;?></span></td>
									</tr>
            	<tr class="active1 table_style" style="font-weight:600;">
                    <td width="50">Sr. No.</td>
                    <td width="80">Roll No.</td>
                    <td width="150">Student Name</td>
                    <td width="150">Father Name</td>
                    <td width="50">Class</td>
                    <td width="50">Batch</td>
                    <td width="70">Total Fee</td>
                    <td width="70">Fee Deposit</td>
                    <td width="70">Fee Due</td>
										<td width="70">Total Installment</td>
                    <td width="80">Photo</td>
										<td width="50">Action</td>
                    <!--<td width="80">View Full Profile</td>-->
                </tr>
								<?php
								$sno=1;

									while($fee_detail=mysqli_fetch_assoc($rs)) {

											if($fee_detail['propic']){
												$propic="images/student_images/".$fee_detail['propic'];
											}else{
												$propic="images/view.gif";
											}
								?>
                <tr class="primary1 table_style2">
                    <td><?php echo $sno++;?></td>
                    <td><?php echo $fee_detail['roll'];?></td>
                    <td><?php echo $fee_detail['s_name'];?></td>
                    <td><?php echo $fee_detail['f_name'];?></td>
                    <td><?php echo $fee_detail['class'];?></td>
                    <td><?php echo $fee_detail['name'];?></td>
                    <td><?php  @ $detail=$fee_detail['total_fees']-$fee_detail['total_fees']*$fee_detail['fee_disc']/100;  $total_fees=$total_fees+$detail; echo $detail?></td>
                    <td><?php  if($fee_detail['submit']){echo $fee_detail['submit'];
											$total_fees_recived=$total_fees_recived+$fee_detail['submit'];
										} else {
                    	echo "0";
                    }?></td>
                    <td><?php
											if(!$fee_detail['submit']){
												$fee_detail['submit']="0";
											}/*
											echo $fee_detail['total_fees']."<br>";
											echo $fee_detail['fee_disc']."<br>";
											echo $fee_detail['submit']."<br>";*/
											if(!$fee_detail['fee_disc']){
												!$fee_detail['fee_disc']=0;
											}
										 echo $stu_remain=$fee_detail['total_fees']-($fee_detail['total_fees']*$fee_detail['fee_disc']/100)-$fee_detail['submit'];
										 $total_remain_fee=$total_remain_fee+$stu_remain;?></td>
										 <td><?php $row=fetchRow("Select id from fees_submit where ROLL=$fee_detail[roll]"); echo $row?></td>
                    <td><img src=<?php echo ROOT.$propic;?> height="30" width="30" /></td><td><a href="index.php?mod=fee&do=edit_fee&student_roll=<?php echo $fee_detail['roll'];?>" title="Edit Profile"><img src=
											<?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a>
										</td>
                    <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
                </tr>
								<?php }?>
								<tr>
									<td colspan="20">
										<?php PaginationDisplay($total_row,$url.'&pageNumber=','','');?>
									</td>
								</tr>
            </table>


					<p style="text-align:left">Total Fee Received : INR <?php echo $total_fees_recived;?> &nbsp; | &nbsp; Out of : INR  <?php echo $total_fees;?>&nbsp; | &nbsp; Remaining Fee : INR <?php echo $total_remain_fee;?></p>

      </div>
			<script type="text/javascript">
				function showroll(){
					roll=$('#roll').val();
					sname=$('#sname').val();
					fname=$('#fname').val();
					classs=$('#classs').val();
					batch=$('#batch').val();
					nod=$('#nod').val();
					$.ajax({
						url:'module/fee/search.php',
						data:'roll='+roll+'&sname='+sname+'&fname='+fname+'&classs='+classs+'&batch='+batch+"&wh='yes'&nod="+nod,
						type:'post',
						success:function(e){
							$('#table').html(e);

						}
					});
					//alert(roll);
				}
			</script>

			<script type="text/javascript">
				function showbatch(classid,batchid){

					//alert(classid);

							//alert(classid);
						$.ajax({
							url:"module/class/show_batch.php",
							data:"cid="+classid,
							type:'POST',
							success:function(e){
								$('#batch').html(e);
								showroll();
							}
						});

				}

				function showpage(where,page){
					$.ajax({
						url:'module/fee/search.php',
						data:"where="+where+"&pageNumber="+page,
						type:'post',
						success:function(e){
							$('#table').html(e);

						}
					});
				}
				function del(id) {
					if (confirm("Do you want to delete")) {
						location.href="index.php?mod=profile&do=see_all_profile&did="+id;
					}
				}
			</script>
