<?php
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$data=fetchOne("select * from student_biodata where id=$id");
	}
if(isset($_POST['roll'])){
		//echo "hi";exit;
		$success=1;
		//print_r($_POST);
		if(!($_POST['roll'])){
			//echo "1hi";exit;
			$_SESSION['eroll']="Enter student roll number";
			$success=0;
		}
		if(!($_POST['s_name'])){
			//echo "2hi";exit;
			$_SESSION['es_name']="Enter student name";
			$success=0;
		}else{
			$_POST['s_name']=ucwords(strtolower($_POST['s_name']));
		}
		if(!($_POST['f_name'])){
			//echo "3hi";exit;
			$_SESSION['ef_name']="Enter student father name";
			$success=0;
		}else{
			$_POST['f_name']=ucwords(strtolower($_POST['f_name']));
		}
		if($_POST['m_name']){
			$_POST['m_name']=ucwords(strtolower($_POST['m_name']));
		}
		if(!($_POST['class'])){
			//echo "5hi";exit;
			$_SESSION['eclass']="Select student class";
			$success=0;
		}
		if(!($_POST['batch'])){
			//echo "6hi";exit;
			$_SESSION['ebatch']="Select student batch";
			$success=0;
		}
		if(!($_POST['f_mobile'])){
			//echo "7hi";exit;
			$_SESSION['ef_mobile']="Enter student father mobile number";
			$success=0;
		}
		if(!($_POST['gender'])){
			$_POST['gender']=$data['gender'];
		}
		if(!($_POST['doa'])){
				$_POST['doa']=$data['doa'];
		}
		if(isset($_FILES['propic']['name']) && $_FILES['propic']['name']){
			//print_r($_FILES);
			if ($data['propic']) {
				unlink("include/images/student_images/".$data['propic']);
			}
			$ext=array('jpg','jpeg','png','JPG','JPEG','PNG');
			$image_ext=substr($_FILES['propic']['name'],strrpos($_FILES['propic']['name'],'.')+1);
			//echo $image_ext;exit;
			if(in_array($image_ext,$ext)){
				//echo "hi";exit;
				$_POST['propic']=time()."_".$_FILES['propic']['name'];
				move_uploaded_file($_FILES['propic']['tmp_name'],'include/images/student_images/'.$_POST['propic']);
			}else {
				//echo "14hi";exit;
					$_SESSION['epropic']="Upload only jpg,jpeg,png,JPG,JPEG,PNG file";
					$success=0;
			}
		}
		//print_r($_SESSION);exit;
		//print_r($_SESSION);
		if($success){
			//print_r($_SESSION);
			$_POST['pswd']=md5($_POST['f_mobile']);
		addUpdate('student_biodata',$_POST,$id);

		?>
		<script>
			location.href="index.php?mod=profile&do=see_all_profile";
		</script>
			<?php

	}
}
 ?>
 <div class="col-lg-3">
	 <?php include_once("left_menu.php");?>
</div>
<div class="col-lg-9">
<form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
	<div class="col-lg-6">
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Roll No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="roll" name="roll"  value="<?php echo ucfirst(stripslashes($data['roll'])); ?>" pattern=".{5}" maxlength="5" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
										<?php if(isset($_SESSION['eroll'])){
											echo $_SESSION['eroll'];
										};?>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Student Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="s_name" name="s_name" value="<?php echo $data['s_name']; ?>" style="text-transform:capitalize;">
										<?php if(isset($_SESSION['e_sname'])){
											echo $_SESSION['e_sname'];
										};?>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Father Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="f_name" name="f_name" value="<?php echo $data['f_name']; ?>" style="text-transform:capitalize;">
										<?php if(isset($_SESSION['ef_name'])){
											echo $_SESSION['ef_name'];
										};?>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Mother Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="m_name" name="m_name" value="<?php echo $data['m_name']; ?>" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Class</label>
                    <div class="col-lg-8">
                    <select class="form-control" onChange="showbatch(this.value)" id="class" name="class">
											<option value="">Select Class</option>
												<?php
													$class_data=fetchAll("select id,name from class");
													foreach($class_data as $class_data){
												?>
												<option value="<?php echo $class_data['id'];?>" <?php if ($class_data['id']==$data['class']){echo "selected";}?>><?php echo $class_data['name'];?></option>
												<?php
												}
												?>

                    </select>
										<?php if(isset($_SESSION['eclass'])){
											echo $_SESSION['eclass'];
										};?>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Batch</label>
                    <div class="col-lg-8">
                    <select class="form-control" id="batch" name="batch">

                    </select>
										<?php if(isset($_SESSION['ebatch'])){
											echo $_SESSION['ebatch'];
										};?>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Email ID</label>
                    <div class="col-lg-8">
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Mobile No. (Father)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="f_mobile" name="f_mobile" value="<?php echo $data['f_mobile'] ?>" pattern=".{10}" maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
										<?php if(isset($_SESSION['ef_mobile'])){
											echo $_SESSION['ef_mobile'];
										};?>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Mobile No. (Mother)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="m_mobile" name="m_mobile" value="<?php echo $data['m_mobile'] ?>" pattern=".{10}" maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Mobile No. (Student)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="s_mobile" name="s_mobile" value="<?php echo $data['s_mobile'] ?>" pattern=".{10}" maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Gender</label>
                    <div class="col-lg-8">
                    <select class="form-control" id="gender" name="gender">
                        <option><?php echo $data['gender'] ?></option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
										<?php if(isset($_SESSION['egender'])){
											echo $_SESSION['egender'];
										};?>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Category</label>
                    <div class="col-lg-8">
                    <select class="form-control" id="cat" name="cat">
                        <option><?php echo $data['cat'] ?></option>
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
                    <input type="text" class="form-control" id="dob" name="dob" value="<?php echo $data['dob'] ?>"  maxlength="10"  style="text-transform:capitalize;" placeholder="DD-MM-YYYY">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Landline No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="ll_no" name="ll_no" value="<?php echo $data['ll_no'] ?>"  style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Address</label>
                    <div class="col-lg-8">
                    <textarea class="form-control" id="adrs" name="adrs" style="text-transform:capitalize;"><?php echo $data['adrs'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">State</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="state" name="state" value="<?php echo $data['state'] ?>" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">District</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="district" name="district" value="<?php echo $data['district'] ?>" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Pin No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="pin" name="pin" value="<?php echo $data['pin'] ?>"  style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Profile Photo</label>
                    <div class="col-lg-8">
                    <input type="file" class="form-control" id="propic" name="propic" value="<?php echo $data['propic'] ?>">
										<?php if(isset($_SESSION['epropic'])){
											echo $_SESSION['epropic'];
										};?>
                    </div>
                </div>
            </div>

      <div class="col-lg-6">
				<div class="form-group">
					<label class="col-lg-4 control-label">Date of Admission</label>
						<div class="col-lg-8">
						<input type="text" class="form-control" id="state" name="doa" value="<?php echo $data['doa'];?>" style="text-transform:capitalize;">
						</div>
				</div>

				<div class="form-group">
					<label class="col-lg-4 control-label">Discount (in %)</label>
						<div class="col-lg-8">
						<input type="text" class="form-control" id="state" name="fee_disc" value="<?php echo $data['fee_disc'] ?>" style="text-transform:capitalize;">
						</div>
				</div>
      		<div class="form-group">
                	<label class="col-lg-4 control-label">Class X Roll No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="10th_roll" name="10th_roll" value="<?php echo $data['10th_roll'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>
      		<div class="form-group">
                	<label class="col-lg-4 control-label">Class X Per./ CGPA</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="10th_%" name="10th_%" value="<?php echo $data['10th_%'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class X School Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="10th_school_name" name="10th_school_name" value="<?php echo $data['10th_school_name'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class X Board</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="10th_board" name="10th_board" value="<?php echo $data['10th_board'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class XII Roll No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="12th_roll" name="12th_roll" value="<?php echo $data['12th_roll'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class XII Per./ CGPA</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="12th_%" name="12th_%" value="<?php echo $data['12th_%'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class XII School Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="12th_school_name" name="12th_school_name" value="<?php echo $data['12th_school_name'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>
            <div class="form-group">
                	<label class="col-lg-4 control-label">Class XII Board</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="12th_board" name="12th_board" value="<?php echo $data['12th_board'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>

            <div class="form-group">
                	<label class="col-lg-4 control-label">AIPMT Roll No(If Eligible)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="aipmt_roll" name="aipmt_roll" value="<?php echo $data['aipmt_roll'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>

            <div class="form-group">
                	<label class="col-lg-4 control-label">AIIMS Roll No(If Eligible)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="aiims_roll" name="aiims_roll" value="<?php echo $data['aiims_roll'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>

            <div class="form-group">
                	<label class="col-lg-4 control-label">AIPVT Roll No(If Eligible)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="aipvt_roll" name="aipvt_roll" value="<?php echo $data['aipvt_roll'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>

            <div class="form-group">
                	<label class="col-lg-4 control-label">IIT Roll No(If Eligible)</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="iit_roll" name="iit_roll" value="<?php echo $data['iit_roll'] ?>" style="text-transform:capitalize;">
                    </div>
            </div>

            <div class="form-group">
                	<label class="col-lg-4 control-label">Remark</label>
                    <div class="col-lg-8">
                    <textarea class="form-control" id="remark" name="remark" style="text-transform:capitalize;"><?php echo $data['remark'] ?></textarea>
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
$( document ).ready( showbatch('<?php echo $data['class'];?>','<?php echo $data['batch'];?>'));
	function showbatch(classid,batchid){
		if(classid!=''){
			$.ajax({
				url:"module/class/show_batch.php",
				data:"cid="+classid+"&batchid="+batchid,
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
