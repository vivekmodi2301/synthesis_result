<?php
//print_r($_POST);
	if(isset($_POST['roll'])){
		//echo "hi";exit;
		$_POST['opswd']=md5($_POST['opswd']);
		if($userpass==$_POST['opswd']){
			$_POST['npswd']=md5($_POST['npswd']);
				$_POST['cpswd']=md5($_POST['cpswd']);
		}
		//echo $userpass."<br>".$_POST['opswd'];
		if($_POST['opswd'] && $_POST['roll'] && $userroll!=$_POST['roll'] || $userpass!=$_POST['opswd']){
			$_SESSION['edetail']="Enter correct username and password";
		}
		else if($_POST['opswd'] && $_POST['cpswd'] && $_POST['roll'] && $_POST['npswd'] && $_POST['npswd']==$_POST['cpswd']){
			$data=array('pswd'=>$_POST['npswd']);
			addUpdate('student_biodata',$data,$usersessionid);
			$_SESSION['success']="Password has been change successfully";
		}
		else{
			$_SESSION['edetail']="Your new confirm password dosen't match";
		}
	}
 ?>
<?php
	$pro_pic=fetchOne("select propic,roll from student_biodata where id=$usersessionid");
 ?>
<div class="col-lg-12">
	<div class="col-lg-2"><?php if($pro_pic['propic']){?>
    <img src=<?php echo  SITE_IMAGES."images/student_images/".$pro_pic['propic'];?> height="150" width="140" />
    <?php }else{
    ?>
    <img src=<?php echo SITE_IMAGES."images/pna.jpg";?>>
    <?php
    }?>
		</div>
			<div class="col-lg-10" style="border-left:1px solid #CCC;">
				<?php if(isset($_SESSION['edetail'])){
					echo $_SESSION['edetail'];
					unset($_SESSION['edetail']);
				}
				if(isset($_SESSION['success'])){
					echo $_SESSION['success'];
					unset($_SESSION['success']);
				}?>
    <form role="form" method="post" class="form-horizontal" name="change_pwd">
            	<div class="form-group">
                	<label class="col-lg-4 control-label">User Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="roll" name="roll"  value="<?php echo $pro_pic['roll'];?>" pattern=".{5}" maxlength="5" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;" >
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Old Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" name="opswd"  id="pswd"  style="text-transform:capitalize;">
                    </div>
                </div>
								<div id="show">
                <div class="form-group">
                	<label class="col-lg-4 control-label">New Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" id="pswd" name="npswd" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Confirm New Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" id="pswd" name="cpswd" style="text-transform:capitalize;">
                    </div>
                </div>
							</div>
							<div class="form-group">
								<div class="col-lg-8 col-lg-offset-4">
									<button type="submit" id="send" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
									</div>
							</div>

            </form>
      </div>
</div>
