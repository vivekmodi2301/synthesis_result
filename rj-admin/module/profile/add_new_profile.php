<?php
	if(isset($_POST['s_name'])){
		$success=1;
		//print_r($_POST);
		if(!($_POST['roll'])){
			$_SESSION['eroll']="Enter student roll number";
			$success=0;
		}
		if(!($_POST['s_name'])){
			$_SESSION['es_name']="Enter student name";
			$success=0;
		}
		if(!($_POST['f_name'])){
			$_SESSION['ef_name']="Enter student father name";
			$success=0;
		}
		if(!($_POST['class'])){
			$_SESSION['eclass']="Select student class";
			$success=0;
		}
		if(isset($_POST['batch'])&& !$_POST['batch']){
			$_SESSION['ebatch']="Select student batch";
			$success=0;
		}
		if(!($_POST['f_mobile'])){
			$_SESSION['ef_mobile']="Enter student father mobile number";
			$success=0;
		}
		if(!($_POST['gender'])){
			$_SESSION['egender']="Select student gender";
			$success=0;
		}
		if(!($_POST['doa'])){
			$_POST['doa']=date('Y-m-d');
		}
		if(isset($_FILES['propic']['name']) && $_FILES['propic']['name']){
			//print_r($_FILES);
/*			$ext=array('jpg','jpeg','png');
			$image_ext=substr($_FILES['propic']['name'],strrpos($_FILES['propic']['name'],'.')+1);
			//echo $image_ext;exit;
			if(in_array($image_ext,$ext)){*/
			if($_FILES['propic']['type']=='image/jpeg'){
						if($size<=595284){
				//echo "hi";exit;
				$_POST['propic']=time()."_".$_FILES['propic']['name'];
				move_uploaded_file($_FILES['propic']['tmp_name'],'include/images/student_images/'.$_POST['propic']);
			}else{
				$_SESSION['epropic']="Upload file less then 97kbps";
			}
		}
			else {
					$_SESSION['epropic']="Upload only jpg,jpeg,png file";
					$success=0;
			}
		}
		if($success){
			$_POST['pswd']=md5($_POST['f_mobile']);
			addUpdate('student_biodata',$_POST);
			?>
			<script>
				location.href="index.php?mod=profile&do=see_all_profile";
			</script>
				<?php
		}
	}
 ?>
<div class="col-lg-12">
<form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
	<div class="col-lg-6">
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Roll No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="roll" name="roll"  value="<?php if(isset($_POST['roll']) && $_POST['roll']){echo $_POST['roll'];}?>" pattern=".{5}" maxlength="5" onchange="check_roll(this.value)" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
											<?php if(isset($_SESSION['eroll']))
					{
						echo $_SESSION['eroll'];
						unset($_SESSION['eroll']);
					}
					?><span id="croll"></span>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Student Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="s_name" name="s_name" value="<?php if(isset($_POST['s_name']) && $_POST['s_name']){echo $_POST['s_name'];}?>" style="text-transform:capitalize;"><?php if(isset($_SESSION['es_name']))
					{
						echo $_SESSION['es_name'];
						unset($_SESSION['es_name']);
					}
					?>

                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Father Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="f_name" name="f_name" value="<?php if(isset($_POST['f_name']) && $_POST['f_name']){echo $_POST['f_name'];}?>" style="text-transform:capitalize;"><?php if(isset($_SESSION['ef_name']))
					{
						echo $_SESSION['ef_name'];
						unset($_SESSION['ef_name']);
					}
					?>

                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Mother Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="m_name" name="m_name" value="<?php if(isset($_POST['m_name']) && $_POST['m_name']){echo $_POST['m_name'];}?>" style="text-transform:capitalize;">

                    </div>
                </div>
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
  <?php if(isset($_SESSION['eclass']))
					{
						echo $_SESSION['eclass'];
						unset($_SESSION['eclass']);
					}
					?>

                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Batch</label>
                    <div class="col-lg-8">
                    <select class="form-control" disabled id="batch" name="batch">
                    	<option value="">Select Batch</option>
                    </select>
                    <?php if(isset($_SESSION['ebatch']))
					{
						echo $_SESSION['ebatch'];
						unset($_SESSION['ebatch']);
					}
					?>

                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Email ID</label>
                    <div class="col-lg-8">
                    <input type="email" class="form-control" id="email" name="email" value="">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Mobile No. (Father)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="f_mobile" name="f_mobile" value="<?php if(isset($_POST['f_mobile']) && $_POST['f_mobile']){echo $_POST['f_mobile'];}?>" pattern=".{10}" maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
											<?php if(isset($_SESSION['ef_mobile']))
					{
						echo $_SESSION['ef_mobile'];
						unset($_SESSION['ef_mobile']);
					}
					?>

                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Mobile No. (Mother)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="m_mobile" name="m_mobile" value="<?php if(isset($_POST['m_mobile']) && $_POST['m_mobile']){echo $_POST['m_mobile'];}?>" pattern=".{10}" maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Mobile No. (Student)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="s_mobile" name="s_mobile" value="<?php if(isset($_POST['s_mobile']) && $_POST['s_mobile']){echo $_POST['s_mobile'];}?>" pattern=".{10}" maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">

                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Gender</label>
                    <div class="col-lg-8">
                    <select class="form-control" id="gender" name="gender">
                    	<option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <?php if(isset($_SESSION['egender']))
					{
						echo $_SESSION['egender'];
						unset($_SESSION['egender']);
					}
					?>

                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Category</label>
                    <div class="col-lg-8">
                    <select class="form-control" id="cat" name="cat">
                    	<option value="<?php if(isset($_POST['cat']) && $_POST['cat']){echo $_POST['cat'];}?> selected">Select Category</option>
                        <option>GEN</option>
                        <option>OBC</option>
                        <option>SC</option>
                        <option>ST</option>
                    </select>

                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">D.O.B.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="dob" name="dob" value="<?php if(isset($_POST['dob']) && $_POST['dob']){echo $_POST['dob'];}?>" pattern=".{10}" maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9-]/g,'');" style="text-transform:capitalize;" placeholder="DD-MM-YYYY">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Landline No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="ll_no" name="ll_no" value="<?php if(isset($_POST['ll_no']) && $_POST['ll_no']){echo $_POST['ll_no'];}?>" pattern=".{10}" maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Address</label>
                    <div class="col-lg-8">
                    <textarea class="form-control" id="adrs" name="adrs" style="text-transform:capitalize;"></textarea>

                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">State</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="state" name="state" value="<?php if(isset($_POST['state']) && $_POST['state']){echo $_POST['state'];}?>" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">District</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="district" name="district" value="<?php if(isset($_POST['district']) && $_POST['district']){echo $_POST['district'];}?>" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Pin No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="pin" name="pin" value="<?php if(isset($_POST['pin']) && $_POST['pin']){echo $_POST['pin'];}?>" pattern=".{6}" maxlength="6" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Profile Photo</label>
                    <div class="col-lg-8">
                    <input type="file" class="form-control" id="propic" name="propic" value="<?php if(isset($_POST['propic']) && $_POST['propic']){echo $_POST['propic'];}?>">
										<?php if(isset($_SESSION['epropic'])){
											echo $_SESSION['epropic'];
										};?>
                    </div>
                </div>
            </div>

      <div class="col-lg-6">
					<div class="form-group">
						<label class="col-lg-4 control-label">Date of Addmission</label>
							<div class="col-lg-8">
							<input type="text" class="form-control" id="state" name="doa" value="<?php echo date('Y-m-d');?>" style="text-transform:capitalize;">
							</div>
					</div>
				<div class="form-group">
					<label class="col-lg-4 control-label">Discount (in %)</label>
						<div class="col-lg-8">
						<input type="text" class="form-control" id="state" name="fee_disc" value="<?php if(isset($_POST['fee_disc']) && $_POST['fee_disc']){echo $_POST['fee_disc'];}else{echo "0";}?>" style="text-transform:capitalize;">
						</div>
				</div>

      		<div class="form-group">
                	<label class="col-lg-4 control-label">Class X Roll No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="10th_roll" name="10th_roll" value="<?php if(isset($_POST['10th_roll']) && $_POST['10th_roll']){echo $_POST['10th_roll'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>
      		<div class="form-group">
                	<label class="col-lg-4 control-label">Class X Per./ CGPA</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="10th_%" name="10th_%" value="<?php if(isset($_POST['l0th_%']) && $_POST['l0th_%']){echo $_POST['l0th_%'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class X School Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="10th_school_name" name="10th_school_name" value="<?php if(isset($_POST['l0th_school_name']) && $_POST['l0th_school_name']){echo $_POST['10th_school_name'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class X Board</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="10th_board" name="10th_board" value="<?php if(isset($_POST['l0th_board']) && $_POST['l0th_board']){echo $_POST['l0th_board'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class XII Roll No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="12th_roll" name="12th_roll" value="<?php if(isset($_POST['l2th_roll']) && $_POST['l2th_roll']){echo $_POST['l2th_roll'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class XII Per./ CGPA</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="12th_%" name="12th_%" value="<?php if(isset($_POST[`12th_%`]) && $_POST[`l2th_%`]){echo $_POST[`l2th_%`];}?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class XII School Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="12th_school_name" name="12th_school_name" value="<?php if(isset($_POST['l2th_school_name']) && $_POST['l2th_school_name']){echo $_POST['l2th_school_name'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class XII Board</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="12th_board" name="12th_board" value="<?php if(isset($_POST['l2th_board']) && $_POST['l2th_board']){echo $_POST['l2th_board'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>

            <div class="form-group">
                	<label class="col-lg-4 control-label">AIPMT Roll No(If Eligible)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="aipmt_roll" name="aipmt_roll" value="<?php if(isset($_POST['aimpt_roll']) && $_POST['aimpt_roll']){echo $_POST['amipt_roll'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>

            <div class="form-group">
                	<label class="col-lg-4 control-label">AIIMS Roll No(If Eligible)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="aiims_roll" name="aiims_roll" value="<?php if(isset($_POST['aiims_roll']) && $_POST['aiims_roll']){echo $_POST['aiims_roll'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>

            <div class="form-group">
                	<label class="col-lg-4 control-label">AIPVT Roll No(If Eligible)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="aipvt_roll" name="aipvt_roll" value="<?php if(isset($_POST['aipvt_roll']) && $_POST['aipvt_roll']){echo $_POST['aipvt_roll'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>

            <div class="form-group">
                	<label class="col-lg-4 control-label">IIT Roll No(If Eligible)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="iit_roll" name="iit_roll" value="<?php if(isset($_POST['iit_roll']) && $_POST['iit_roll']){echo $_POST['iit_roll'];}?>" style="text-transform:capitalize;">
                    </div>
            </div>

            <div class="form-group">
                	<label class="col-lg-4 control-label">Remark</label>
                    <div class="col-lg-8">
                    <textarea class="form-control" id="remark" name="remark" style="text-transform:capitalize;"></textarea>
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
<script type="text/javascript">
function check_roll(roll) {
	$.ajax({
		url:"module/profile/check_roll.php",
		data:"roll="+roll,
		type:'POST',
		success:function(e){
			$('#croll').html(e);
		}
	});
}
</script>
